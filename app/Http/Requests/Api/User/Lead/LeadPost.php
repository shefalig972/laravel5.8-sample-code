<?php

namespace App\Http\Requests\Api\User\Lead;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'potential_revenue' => 'nullable',
            'interest_level' => 'max:20',
            'event_type' => 'required|max:15',
            'service_type_id' => 'nullable|required|integer',
            'when' => 'max:100',
            'location' => 'max:255',
            'lat_long' => 'max:100',
            'lead_source_type' => 'max:20',
            'lead_source_value' => 'max:100',
            'new_contact' => 'required|boolean',
            'first_name' => 'nullable|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'nullable|email|max:100',
            'phone_type' => 'nullable|max:50',
            'phone' => 'nullable|max:20',
            'organization' => 'nullable|max:100',
            'title' => 'nullable|max:100',
            'contact_id' => 'nullable',
            'lead_status_types_id' => 'required|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Lead name is required!',
            'lead_status_types_id.required' => 'Lead stage name is required!'
        ];
    }


    public function filters()
    {
        return [
            'name' => 'trim|escape|strip_tags',
            'potential_revenue' => 'trim|escape|strip_tags',
            'interest_level' => 'trim|escape|strip_tags',
            'event_type' => 'capitalize|escape|strip_tags|trim',
            'service_type_id' => 'escape|strip_tags|trim',
            'when' => 'capitalize|escape|strip_tags|trim',
            'location' => 'capitalize|escape|strip_tags|trim',
            'lat_long' => 'capitalize|escape|strip_tags|trim',
            'lead_source_type' => 'escape|strip_tags|trim',
            'lead_source_value' => 'capitalize|escape|strip_tags|trim',
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
            'lead_status_types_id' => 'escape|strip_tags|trim',
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
