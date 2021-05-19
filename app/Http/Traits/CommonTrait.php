<?php

namespace App\Http\Traits;

use App\Lead;
use App\Quote;
use App\Booking;
use App\Contact;
use App\Invoice;
use Carbon\Carbon;
use App\SourceType;
use App\ServiceType;
use App\LeadStatusType;
use App\UserPreferenceView;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

trait CommonTrait
{
    public function returnSuccess(array $messages, $code)
    {
        return response()->json($messages, $code);
    }

    public function returnFailure(array $messages, $code)
    {
        return response()->json($messages, $code);
    }

    public function returnResponse(array $response, $code = null)
    {
        if ($response['success']) {
            $code = $code ? $code : 200;
            $response['statusCode'] = $code;
            $response['user_preferences'] = [];

            if (Auth::user() && isset(Auth::user()->userOrgMap->id)) {

                $response['user_preferences'] =  UserPreferenceView::where('user_org_map_id', Auth::user()->userOrgMap->id)->get();
            }

            return $this->returnSuccess($response, $code);
        }
        $code = $code ? $code : 400;
        $response['statusCode'] = $code;
        return $this->returnFailure($response, $code);
    }

    public function returnData($data, $message)
    {
        $user_preferences = [];
        if(Auth::user()) $user_preferences =  UserPreferenceView::where('user_org_map_id', $this->getUserOrgMapId())->get();

        $response = ['success' => true, 'message' => $message, 'data' => $data,'user_preferences'=> $user_preferences,'statusCode' => 200];
        return $this->returnResponse($response);
    }

    public function throwException($e)
    {
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
            'data' => [],
            'statusCode' => 400
        ];
        return response()->json($response, 400);
    }

    public function getUserOrgMapId()
    {
        $payload = JWTAuth::parseToken()->getPayload();
        return $payload->get('user_org_map_id');
    }


    public function getPaginator($request)
    {
        $limit = $request->limit == '' ? 1000 : $request->limit;
        $limit = $limit > 1000 ? 1000 : $limit;
        $page = $request->page == '' ? 0 : $request->page;
        $offset = ($page - 1) * $limit;
        $sortingField = $request->sortingField == '' ? 'id' : $request->sortingField;
        $sortingOrder = $request->sortingOrder == 'ASC' ? 'ASC' : 'DESC';
        return array('limit' => $limit, 'page' => $page, 'offset' => $offset, 'sortingField' => $sortingField, 'sortingOrder' => $sortingOrder);
    }

    public function getSourceType($id)
    {
        # check if source type belongs to this user
        $checkSourceType = SourceType::where(['id' => $id,'user_org_map_id' => $this->getUserOrgMapId()])->count();
        return $checkSourceType;
    }

    public function getServiceType($id)
    {
        # check if service type belongs to this user
        $checkServiceType = ServiceType::where(['id' => $id,'user_org_map_id' => $this->getUserOrgMapId()])->count();
        return $checkServiceType;
    }

    public function getEntityCount($user_org_map_id)
    {
        $today = Carbon::now()->format('Y-m-d');
        $contacts = Contact::where('user_org_map_id','=', $user_org_map_id)->count();
        $leads = Lead::where('user_org_map_id','=', $user_org_map_id)->count();
        $quotes = Quote::where('user_org_map_id','=', $user_org_map_id)->where('quote_status_type_id','!=',5)->where('is_archived', '=', 0)->count();
        $bookings = Booking::where('user_org_map_id','=', $user_org_map_id)->whereDate('start_date', '>=',$today)->count();
        $invoices = Invoice::where('user_org_map_id', '=', $user_org_map_id)->where('invoice_status_type_id', '!=', 5)->count();
        $data = [
                'contacts' => $contacts, 'leads' => $leads, 'bookings' => $bookings, 'quotes' => $quotes, 'invoices' => $invoices
        ];
        return $data;
    }

    public function getImageData($path){
        $file2 =     file_get_contents($path);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        if($type== 'svg'){
            $type= 'svg+xml';
        }

        return 'data:image/' . $type . ';base64,' . base64_encode($file2);;
    }
}
