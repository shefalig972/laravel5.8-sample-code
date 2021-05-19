<?php

namespace App\Http\Requests\Api\User\Quotes;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCustomerRequest extends FormRequest
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
            'id' => 'required|integer',
            'name' => 'required|max:255',            
            'contact_id' => 'nullable|integer',
            'first_name' => 'nullable|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'nullable|email|max:100',
            'phone_type' => 'nullable|max:50',
            'phone' => 'nullable|max:20',
            'organization' => 'nullable|max:100',
            'title' => 'nullable|max:100',
        ];
    }

    public function messages()
    {
        return [
            'contact_id.required' => 'Contact id is required!',
            'new_contact.required' => 'New contact option is required!',
        ];
    }


    public function filters()
    {
        return [
            'contact_id' => 'trim|escape|strip_tags',
            'quote_serial_no' => 'capitalize|escape|strip_tags|trim',
            'email' => 'trim|escape|strip_tags',
            'first_name' => 'capitalize|escape|strip_tags|trim',
            'last_name' => 'capitalize|escape|strip_tags|trim',
            'phone_type' => 'capitalize|escape|strip_tags|trim',
            'phone' => 'capitalize|escape|strip_tags|trim',
            'organization' => 'capitalize|escape|strip_tags|trim',
            'title' => 'capitalize|escape|strip_tags|trim',
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
