<?php

namespace App\Http\Requests\Api\User\Booking;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePost extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'service_type_id' => 'required|max:50',
            'amount' => 'nullable',
            'received_amount' => 'nullable',
            'event_type' => 'nullable|max:15',
            'virtual_event' => 'nullable|integer',
            'start_date' => 'required|max:19',
            'duration' => 'nullable|max:50',
            'location' => 'required_if:event_type,1',
            'lat_long' => 'nullable',
            'detail' => 'nullable',
            'new_contact' => 'required|boolean',
            'first_name' => 'nullable|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'nullable|email|max:100',
            'phone_type' => 'nullable|max:50',
            'phone' => 'nullable|max:20',
            'organization' => 'nullable|max:100',
            'title' => 'nullable|max:100',
            'contact_id' => 'nullable',
            'meeting_id' => 'nullable|max:255',
            'passcode' => 'nullable|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Booking name is required!',
            'service_type_id.required' => 'Service ID is required!',
            'start_date.required' => 'Start date is required!'
        ];
    }


    public function filters()
    {
        return [
            'name' => 'trim|escape|strip_tags',
            'service_type_id' => 'trim|escape|strip_tags',
            'amount' => 'escape|strip_tags|trim',
            'received_amount' => 'escape|strip_tags|trim',
            'event_type' => 'capitalize|escape|strip_tags|trim',
            'start_date' => 'escape|strip_tags|trim',
            'duration' => 'capitalize|escape|strip_tags|trim',
            'location' => 'escape|strip_tags|trim',
            'lat_long' => 'escape|strip_tags|trim',
            'detail' => 'escape|strip_tags|trim',
            'new_contact' => 'escape|strip_tags|trim',
            'first_name' => 'capitalize|escape|strip_tags|trim',
            'last_name' => 'capitalize|escape|strip_tags|trim',
            'email' => 'escape|strip_tags|trim',
            'phone_type' => 'escape|strip_tags|trim',
            'phone' => 'escape|strip_tags|trim',
            'organization' => 'escape|strip_tags|trim',
            'title' => 'escape|strip_tags|trim',
            'contact_id' => 'escape|strip_tags|trim',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $values = [
            'success' => false,
            'errorType' => "VALIDATION_ERROR",
            'message' => ['validation' => $validator->errors()],
            'data' => [],
            'statusCode' => 412
        ];
        throw new HttpResponseException(response($values, 412));
    }
}
