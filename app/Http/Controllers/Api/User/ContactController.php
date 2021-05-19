<?php

namespace App\Http\Controllers\Api\User;

use App\Lead;
use App\Booking;
use App\Contact;
use App\BookingNote;
use App\BookingTask;
use App\ContactNote;
use App\ContactTask;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ContactList;
use App\Http\Requests\Api\User\ContactPost;
use App\Http\Requests\Api\User\ContactView;
use App\Http\Traits\Api\Common\ContactTrait;
use App\Http\Requests\Api\User\ContactNoteList;
use App\Http\Requests\Api\User\ContactNotePost;
use App\Http\Requests\Api\User\ContactNoteView;
use App\Http\Requests\Api\User\ContactNoteDelete;
use App\Http\Requests\Api\User\ContactNoteUpdate;
use App\Http\Requests\Api\User\Contact\ContactDelete;
use App\Http\Requests\Api\User\Contact\ContactUpdate;
use App\Http\Requests\Api\User\Contact\FinalizeImport;
use App\Http\Requests\Api\User\Contact\Task\ContactTaskNew;
use App\Http\Requests\Api\User\Contact\Task\ContactTaskList;
use App\Http\Requests\Api\User\Contact\Task\ContactTaskView;
use App\Http\Requests\Api\User\Contact\Task\ContactTaskDelete;
use App\Http\Requests\Api\User\Contact\Task\ContactTaskUpdate;
use App\LeadNote;
use App\LeadTask;
use App\Quote;
use App\QuoteDescription;
use App\QuoteTimeline;

class ContactController extends Controller
{
    use ContactTrait, CommonTrait;

    public function __construct()
    {

    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/create",
     *     summary="Create new contact",
     *     description="Create new contact",
     *     operationId="/v1/contact/create",
     *     tags={"Contact"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="first_name",
     *      in="query",
     *      description="First name of contact",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="last_name",
     *      in="query",
     *      description="Last name of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="email id of contact",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="phone_type",
     *      in="query",
     *      description="Phone type of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="phone number of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="organization",
     *      in="query",
     *      description="Organization name of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="title",
     *      in="query",
     *      description="Title number of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="referred_by",
     *      in="query",
     *      description="Contact Id of person who referred this contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="first_name_information",
     *      in="query",
     *      description="Contact details",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function create(ContactPost $request)
    {
        try {
            $post = $request->all();
            $response = $this->newContact($post);
        } catch (\Exception $e) {
            return $this->throwException($e);
        }
        return  $response;
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/update",
     *     summary="Update an existing contact",
     *     description="Update an existing contact",
     *     operationId="/v1/contact/update",
     *     tags={"Contact"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="first_name",
     *      in="query",
     *      description="First name of contact",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="last_name",
     *      in="query",
     *      description="Last name of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="email",
     *      in="query",
     *      description="email id of contact",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="phone_type",
     *      in="query",
     *      description="Phone type of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="phone",
     *      in="query",
     *      description="phone number of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="organization",
     *      in="query",
     *      description="Organization name of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="title",
     *      in="query",
     *      description="Title number of contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="referred_by",
     *      in="query",
     *      description="Contact Id of person who referred this contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="first_name_information",
     *      in="query",
     *      description="Contact details",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function update(ContactUpdate $request)
    {
        $checkContact = $this->getUserContact($request->id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        try {
            if (!empty($request->email)) {
                #check for duplicate email
                $checkEmail = Contact::where('id','!=',$request->id)
                    ->where('user_org_map_id','=', $this->getUserOrgMapId())
                    ->where('email','=',$request->email)->firstOrFail();
                return $this->returnResponse(trans('api_messages.customer.contact.email-exists'));
            }
        } catch (\Exception $e) {}
        try {
            Contact::where('id','=', $request->id)->update($request->except('id'));
            $contact = Contact::where('id','=', $request->id)->first();
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnData($contact, 'Contact updated successfully.');
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/delete",
     *     summary="delete mulitple contacts",
     *     description="delete multiple contacts",
     *     operationId="/v1/contact/delete",
     *     tags={"Contact"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Comma separated contact ids",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Contacts deleted successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function delete(ContactDelete $request)
    {
        DB::beginTransaction();
        try {
            # check if contactIds belong to the user
            $contactIds = explode(',', $request->contact_id);
            $checkContact = Contact::whereIn('id',$contactIds)->select('id')->where('user_org_map_id','=', $this->getUserOrgMapId())->withCount('leads','bookings', 'quotes')->get();
           
            if ($checkContact->count() != count($contactIds)) {
                return $this->returnResponse(trans('api_messages.failure'));
            }

            # If contact has associated lead/booking, then DO NOT delete
            foreach ($checkContact as $contact) {
                if($contact->leads_count >= 1 || $contact->bookings_count >= 1|| $contact->quotes_count >= 1){
                    if($checkContact->count() == 1) return $this->returnResponse(trans('api_messages.customer.contact.cannot-deleted-single'));
                    return $this->returnResponse(trans('api_messages.customer.contact.cannot-deleted-multiple'));
                }
            }

            
            # set null value to all the references
            Contact::whereIn('referred_by',$contactIds)->update(['referred_by' => null]);
            Lead::whereIn('referred_by', $contactIds)->update(['referred_by' => null]);
            # delete all notes and tasks
            ContactNote::whereIn('contact_id',$contactIds)->delete();
            ContactTask::whereIn('contact_id',$contactIds)->delete();
            Contact::whereIn('id',$contactIds)->delete();

           
           


        } catch (\Exception $e) {   
                 
            DB::rollBack();
            return $this->returnResponse(trans('api_messages.failure'));
        }
        DB::commit();
        return $this->returnResponse(trans('api_messages.customer.contact.deleted'));
    }

    /**
     * @OA\Get  (
     *     path="/v1/contact/view",
     *     summary="View contact details",
     *     description="View contact details",
     *     operationId="/v1/contact/view",
     *     tags={"Contact"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="fields",
     *      in="query",
     *      description="Fields name of contact table",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function view(ContactView $request)
    {
        try {
            $fields = $request->fields == '' ? '*' : explode(',', $request->fields);
            $contact = Contact::where(['id' => $request->id,'user_org_map_id' => $this->getUserOrgMapId()])
                ->select($fields)
                ->with('referredBy','leads')
                ->first();
            if($contact == null) {
                $contact = [];
            }
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnData($contact, 'success');
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/list",
     *     summary="Fetch contact List",
     *     description="Fetch contact List",
     *     operationId="/v1/contact/list",
     *     tags={"Contact"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="fields",
     *      in="query",
     *      description="Fields name of contact table",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      description="Number of records per page",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page number",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="filter",
     *      in="query",
     *      description="Search term",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function list(ContactList $request)
    {
        try {
            $fields = $request->fields == '' ? '*' : explode(',', $request->fields);
            $filter = $request->filter == '' ? null : $request->filter;
            $paginator = $this->getPaginator($request);

            $query = Contact::where(['user_org_map_id' => $this->getUserOrgMapId()]);
            $query->select($fields);
            if ($filter){
                $columns = [DB::raw("concat(first_name, ' ', last_name)"),'first_name','last_name','email','phone','organization'];
                $query->where(function ($q) use ($columns, $filter) {
                    foreach ($columns as $column) {
                        $q->orWhere($column, 'like', "%{$filter}%");
                    }
                });
            }
            $query->with('leads','bookings', 'referredBy', 'invoices');
            $query->orderBy($paginator['sortingField'], $paginator['sortingOrder']);
            $total = $query->count();
            $contact = $query->skip($paginator['offset'])->limit($paginator['limit'])->get();
            if($total == 0) $contact = [];
            $response = [
                'success' => true,
                'message' => 'success',
                'data' => $contact,
                'total' => $total
            ];
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse($response);
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/import",
     *     summary="Import contact",
     *     description="Import contact",
     *     operationId="/v1/contact/import",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="import_file",
     *      in="query",
     *      description="Import file",
     *      required=true,
     *      @OA\Schema(type="file")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Contact imported successfully successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function import(Request $request)
    {
        try {
            return $this->importContact($request);
        } catch (\Exception $e) {
            return $this->throwException($e->getMessage());
        }
    }

    /*public function finalizeImport(FinalizeImport $request)
    {
        try {
            return $this->copyImportedContact($request->import_id);
        } catch (\Exception $e) {
            return $this->throwException($e->getMessage());
        }
    }*/

    /**
     * @OA\Post  (
     *     path="/v1/contact/note/create",
     *     summary="Create note for contact",
     *     description="Create note for contact",
     *     operationId="/v1/contact/note/create",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="detail",
     *      in="query",
     *      description="Contact note detail",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function createNote(ContactNotePost $request)
    {
        try {
            # check if contact_id belongs to this user
            $checkContact = Contact::where(['id' => $request->contact_id,'user_org_map_id' => $this->getUserOrgMapId()])->count();
            if ($checkContact == 0) {
                return $this->returnResponse(trans('api_messages.failure'));
            }
            $note = ContactNote::create($request->all());
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse(trans('api_messages.customer.contact.note.created'));
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/note/update",
     *     summary="Update note for contact",
     *     description="Update note for contact",
     *     operationId="/v1/contact/note/update",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Note id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="detail",
     *      in="query",
     *      description="Contact note detail",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function noteUpdate(ContactNoteUpdate $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        try {
            $note = ContactNote::where(['id' => $request->id,'contact_id' => $request->contact_id])
                ->update(['detail' => $request->detail]);
            $note = ContactNote::where('id','=',$request->id)->first();
            return $this->returnData($note, 'Note updated successfully!');
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/note/delete",
     *     summary="Delete note for contact",
     *     description="Delete note for contact",
     *     operationId="/v1/contact/note/delete",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Note id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function noteDelete(ContactNoteDelete  $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        try {
            $note = ContactNote::where(['id' => $request->id,'contact_id' => $request->contact_id])
                ->delete();
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse(trans('api_messages.customer.contact.note.deleted'));
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/note/view",
     *     summary="View contact note detail",
     *     description="View contact note detail",
     *     operationId="/v1/contact/note/view",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Note id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function noteView(ContactNoteView  $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }

        try {
            $note = ContactNote::where(['id' => $request->id,'contact_id' => $request->contact_id])
                ->first();
            if ($note == null) $note = [];
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnData($note, 'success');
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/note/list",
     *     summary="Fetch list of contact notes",
     *     description="Fetch list of contact notes",
     *     operationId="/v1/contact/note/list",
     *     tags={"Contact Note"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="fields",
     *      in="query",
     *      description="Fields(columns) of contact table",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      description="Number of records per page",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page no.",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function noteList(ContactNoteList  $request)
    {
        try{
        $fields = $request->fields == '' ? '*' : explode(',', $request->fields);
        $paginator = $this->getPaginator($request);

        $query = ContactNote::where(['contact_id' => $request->contact_id]);
        $query->select($fields);
        $query->orderBy($paginator['sortingField'], $paginator['sortingOrder']);
        $total = $query->count();
        $notes = $query->skip($paginator['offset'])->limit($paginator['limit'])->get();
        if($total == 0) $notes = [];
        $response = [
            'success' => true,
            'message' => 'success',
            'data' => $notes,
            'total' => $total
        ];
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse($response);
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/task/create",
     *     summary="Create contact task",
     *     description="Create contact task",
     *     operationId="/v1/contact/task/create",
     *     tags={"Contact Task"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="task_due_type",
     *      in="query",
     *      description="Task due type eg. in 2 days",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="task_type",
     *      in="query",
     *      description="Contact task type eg. to-do",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="refer_to",
     *      in="query",
     *      description="Contact id of person who reffered this contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="detail",
     *      in="query",
     *      description="Task detail",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="custom_date",
     *      in="query",
     *      description="Customer due date",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function createTask(ContactTaskNew $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->createContactTask($request);
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/task/update",
     *     summary="Create contact task",
     *     description="Create contact task",
     *     operationId="/v1/contact/task/update",
     *     tags={"Contact Task"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Contact task id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="task_due_type",
     *      in="query",
     *      description="Task due type eg. in 2 days",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="task_type",
     *      in="query",
     *      description="Contact task type eg. to-do",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="refer_to",
     *      in="query",
     *      description="Contact id of person who reffered this contact",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="detail",
     *      in="query",
     *      description="Task detail",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="custom_date",
     *      in="query",
     *      description="Customer due date",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function updateTask(ContactTaskUpdate $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->updateContactTask($request);
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/task/delete",
     *     summary="Delete contact task",
     *     description="Delete contact task",
     *     operationId="/v1/contact/task/delete",
     *     tags={"Contact Task"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Contact task id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="User Registered successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function deleteTask(ContactTaskDelete $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }

        try {
            $task = ContactTask::where(['id' => $request->id,'contact_id' => $request->contact_id])->delete();
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse(trans('api_messages.customer.contact.task.deleted'));
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/task/view",
     *     summary="View contact task details",
     *     description="View contact task details",
     *     operationId="/v1/contact/task/view",
     *     tags={"Contact Task"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="id",
     *      in="query",
     *      description="Contact task id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Data fetched successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function viewTask(ContactTaskView $request)
    {
        $checkContact = $this->getUserContact($request->contact_id);
        if ($checkContact == 0) {
            return $this->returnResponse(trans('api_messages.failure'));
        }

        try {
            $task = ContactTask::where(['id' => $request->id,'contact_id' => $request->contact_id])
                ->with('referTo')->first();
            if ($task == null) $task = [];
            $task = $this->updateDueTypeTask($task);
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnData($task, 'success');
    }

    /**
     * @OA\Post  (
     *     path="/v1/contact/task/list",
     *     summary="Fetch list of contact tasks",
     *     description="Fetch list of contact tasks",
     *     operationId="/v1/contact/task/list",
     *     tags={"Contact Task"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="contact_id",
     *      in="query",
     *      description="Contact id",
     *      required=true,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="fields",
     *      in="query",
     *      description="Fields(columns) name of Contact task table",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="limit",
     *      in="query",
     *      description="Number of records per page.",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Parameter(
     *      name="page",
     *      in="query",
     *      description="Page no.",
     *      required=false,
     *      @OA\Schema(type="string")
     *      ),
     *     @OA\Response(
     *      response="200",
     *      description="Data fetched successfully.",
     *      @OA\JsonContent()
     *      ),
     *     @OA\Response(
     *      response="400",
     *      description="Bad request",
     *      )
     * )
     *
     */
    public function listTask(ContactTaskList $request)
    {
        try{
            $fields = $request->fields == '' ? '*' : explode(',', $request->fields);
            $paginator = $this->getPaginator($request);

            $query = ContactTask::where(['contact_id' => $request->contact_id]);
            if ($request->has('status')) {
                $query->where('status', '=', $request->status);
            }
            $query->with('referTo');
            $query->orderBy($paginator['sortingField'], $paginator['sortingOrder']);
            $total = $query->count();
            $task = $query->skip($paginator['offset'])->limit($paginator['limit'])->get();
            if($total == 0) $task = [];
            $task = $this->updateDueType($task);
            $response = [
                'success' => true,
                'message' => 'success',
                'data' => $task,
                'total' => $total
            ];
        } catch (\Exception $e) {
            return $this->returnResponse(trans('api_messages.failure'));
        }
        return $this->returnResponse($response);
    }
}
