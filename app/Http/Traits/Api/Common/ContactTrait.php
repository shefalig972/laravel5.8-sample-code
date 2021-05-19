<?php

namespace App\Http\Traits\Api\Common;

use App\Contact;
use App\ContactTask;
use App\ImportContactQueue;
use App\Lead;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use Tymon\JWTAuth\Facades\JWTAuth;

trait ContactTrait
{
    public function newContact($post)
    {
        try {
            if (isset($post['email'])) {
                $duplicate = Contact::where('user_org_map_id','=', $this->getUserOrgMapId())
                    ->where('email','=', $post['email'])
                    ->firstOrFail();
                return $this->returnResponse(trans('api_messages.customer.contact.email-exists'));
            }
        } catch (\Exception $e) {}
        try {
            $payload = JWTAuth::parseToken()->getPayload();
            $post['user_org_map_id'] = $payload->get('user_org_map_id');
            $contact = Contact::create($post);
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        $response = [
            'success' => true,
            'message' => 'Contact created successfully.',
            'data' => $contact
        ];
        return $this->returnResponse($response);
    }

    public function updateContact($post)
    {
        try {
            if (!empty($post['email'])) {
                #check for duplicate email
                $checkEmail = Contact::where('id','!=',$post['id'])
                    ->where('user_org_map_id','=', $this->getUserOrgMapId())
                    ->where('email','=',$post['email'])->firstOrFail();
                return $this->returnResponse(trans('api_messages.customer.contact.email-exists'));
            }
        } catch (\Exception $e) {}
        try {
            Contact::where('id','=', $post['id'])->update($post);
            $contact = Contact::where('id','=', $post['id'])->first();
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnData($contact, 'Contact updated successfully.');
    }

    public function getUserContact($contact_id)
    {
        # check if contact_id belongs to this user
        $checkContact = Contact::where(['id' => $contact_id,'user_org_map_id' => $this->getUserOrgMapId()])->count();
        return $checkContact;
    }

    public function importContact($request)
    {
        try {
            $userOrgMapId = $this->getUserOrgMapId();
            $emptyTableRow = [
                'user_org_map_id' => $userOrgMapId,
                'first_name' => null
            ];
            $validFormats = ['xlsx', 'xls','csv'];
            $fileExtension = $request->file('import_file')->getClientOriginalExtension();
            if (!in_array($fileExtension, $validFormats)) {
                return $this->returnResponse(trans('api_messages.customer.contact.excel.invalid-format'));
            }
            $importFile = IOFactory::createReader(ucfirst($fileExtension));
            $importFile->setReadDataOnly(true);
            $workSheet = $importFile->load($request->file('import_file'));
            $workSheet = $workSheet->getActiveSheet();
            $excelColumns = ['first_name' => null, 'email' => null, 'phone' => null];
            $counter = 0;
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        DB::beginTransaction();
        try {
            $today = Carbon::now();
            foreach ($workSheet->getRowIterator() AS $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false); // This loops through all cells,
                $cells = [];
                $maxExcelColumn = 0;
                foreach ($cellIterator as $cell) {
                    if ($maxExcelColumn > 15) break;
                    $cells[] = $cell->getValue();
                    $maxExcelColumn++;
                }
                if ($counter == 0) {
                    foreach ($cells as $key => $value) {
                        if (strcasecmp($value, 'First Name') == 0) {
                            $excelColumns['first_name'] = $key;
                        } elseif (strcasecmp($value, 'Last Name') == 0) {
                            $excelColumns['last_name'] = $key;
                        } elseif (strcasecmp($value, 'E-mail Address') == 0) {
                            $excelColumns['email'] = $key;
                        } elseif (strcasecmp($value, 'Phone Number') == 0) {;
                            $excelColumns['phone'] = $key;
                        }elseif($value){
                            $excelColumns[$value] = $key;
                        }
                    }
                    if (in_array(null, $excelColumns, true)) {
                        return $this->returnResponse(trans('api_messages.customer.contact.excel.invalid-col'));
                    }
                    $counter++;
                    continue;
                }
                $tableRow = $emptyTableRow;
                $tableRow['first_name'] = $cells[$excelColumns['first_name']];
                if (in_array(null, $tableRow, true)) {
                    DB::rollBack();
                    return $this->returnResponse(trans('api_messages.customer.contact.excel.value-missing'));
                }
                $tableRow['email'] = $cells[$excelColumns['email']];
                $tableRow['phone'] = $cells[$excelColumns['phone']];
                $tableRow['last_name'] = $cells[$excelColumns['last_name']];
                $tableRow['first_name_information'] = '';
                foreach ($cells as $k => $v) {
                    if ($k != $excelColumns['first_name'] && $k != $excelColumns['last_name'] && $k != $excelColumns['email'] && $k != $excelColumns['phone']) {
                        $tableRow['first_name_information'] = $tableRow['first_name_information'] == '' ? $v : $tableRow['first_name_information']. ', '.$v;
                    }
                }
                $tableRow['first_name_information'] = trim($tableRow['first_name_information'], ", ");

                # add flag that contact is imported
                $tableRow['is_imported'] = 1;
                $tableRow['imported_on'] = $today;
                if (empty($tableRow['first_name'])) continue;
                if (!empty($tableRow['email'])) {
                    try {
                        # check if duplicate email
                        $checkEmail = Contact::where('user_org_map_id','=', $this->getUserOrgMapId())
                            ->where('email','=',$tableRow['email'])->firstOrFail();
                        # then update
                        Contact::where('user_org_map_id','=', $this->getUserOrgMapId())
                            ->where('email','=',$tableRow['email'])->update($tableRow);
                    } catch (\Exception $e) {
                        # else create
                        Contact::create($tableRow);
                    }
                }else{
                    Contact::create($tableRow);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnResponse(trans('api_messages.failure'));
        }
        DB::commit();
        return $this->returnResponse(trans('api_messages.customer.contact.excel.imported'));
    }

    public function createContactTask(Request $request)
    {
        DB::beginTransaction();
        try {
            $task_due_types = [
                'Due in 1 Day' => Carbon::now()->addDay(1)->format('Y-m-d'),
                'Due in 3 Days' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'Due in 1 Week' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'Due in 1 Month' => Carbon::now()->addMonth(1)->format('Y-m-d'),
                'No due date' => null,
                'Custom' => $request->custom_date,
            ];
            if ($request->task_due_type != 'No due date' && !isset($task_due_types[$request->task_due_type])) {
                return $this->returnResponse(trans('api_messages.customer.contact.task.invalid-due-type'));
            }
            $values = [
                'contact_id' => $request->contact_id,
                'task_due_type' => $request->task_due_type,
                'custom_date' => $task_due_types[$request->task_due_type],
                'task_type' => $request->task_type,
                'refer_to' => $request->refer_to,
                'detail' => $request->detail,
                'status' => 0
            ];
            ContactTask::create($values);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnResponse(trans('api_messages.failure'));
        }
        DB::commit();
        return $this->returnResponse(trans('api_messages.customer.contact.task.created'));
    }

    public function updateContactTask(Request $request)
    {
        DB::beginTransaction();
        try {
            $task_due_types = [
                'Due in 1 Day' => Carbon::now()->addDay(1)->format('Y-m-d'),
                'Due in 3 Days' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'Due in 1 Week' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'Due in 1 Month' => Carbon::now()->addMonth(1)->format('Y-m-d'),
                'No due date' => null,
                'Custom' => $request->custom_date,
            ];
            if ($request->task_due_type != 'No due date' && !isset($task_due_types[$request->task_due_type])) {
                return $this->returnResponse(trans('api_messages.customer.contact.task.invalid-due-type'));
            }
            $values = [
                'contact_id' => $request->contact_id,
                'task_due_type' => $request->task_due_type,
                'custom_date' => $task_due_types[$request->task_due_type],
                'task_type' => $request->task_type,
                'refer_to' => $request->refer_to,
                'detail' => $request->detail,
                'status' => $request->status ? $request->status : 0
            ];
            ContactTask::where('id','=',$request->id)->update($values);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->returnResponse(trans('api_messages.failure'));
        }
        DB::commit();
        $task = ContactTask::where(['id' => $request->id])->with('referTo')->first();
        if ($task == null) $task = [];
        $task = $this->updateDueTypeTask($task);
        return $this->returnData($task, 'Task updated successfully!');
    }

    public function updateDueType($tasks)
    {
        foreach ($tasks as $task) {
            if ($task->task_due_type != 'No due date'){
                $today = Carbon::now()->startOfDay();
                $custom_date = $task->custom_date->startOfDay();
                $diffDate = $today->diffInDays($custom_date);
                if ($custom_date->isToday()) {
                    $due = 'Due Today';
                } elseif ($custom_date->isFuture()) {
                    if($diffDate > 31){
                        $due = $custom_date->format('D, M d');
                    }elseif ($diffDate == 30 || $diffDate == 31) {
                        $due = 'Due in 1 Month';
                    } elseif ($diffDate == 7) {
                        $due = 'Due in 1 Week';
                    }
                    else{
                        $days = $diffDate > 1 ? 'Days' : 'Day';
                        $due = 'Due in ' . $diffDate . ' '.$days;
                    }
                }else{
                    $due = 'Overdue';
                }
                $task->task_due_type = $due;
            }
        }
        return $tasks;
    }

    public function updateDueTypeTask($task)
    {
        if ($task->task_due_type != 'No due date') {
            $today = Carbon::now()->startOfDay();
            $custom_date = $task->custom_date->startOfDay();
            $diffDate = $today->diffInDays($custom_date);
            if($diffDate > 31){
                $due = $custom_date->format('D, M d');
            }elseif ($custom_date->isToday()) {
                $due = 'Due Today';
            } elseif ($custom_date->isFuture()) {
                if ($diffDate == 30 || $diffDate == 31) {
                    $due = 'Due in 1 Month';
                } elseif ($diffDate == 7) {
                    $due = 'Due in 1 Week';
                }else{
                    $days = $diffDate > 1 ? 'Days' : 'Day';
                    $due = 'Due in ' . $diffDate . ' '.$days;
                }
            }else{
                $due = 'Overdue';
            }
            $task->task_due_type = $due;
        }

        return $task;
    }
}
