<?php

namespace App\Http\Requests\Api\User\Quote;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateQuoteRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'name' => 'required|max:255|min:1',
            'quote_template_id' => 'nullable|integer',
            'valid_through' => 'nullable|integer',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'event_duration' => 'nullable|max:20',
            'event_location' => 'nullable|max:255',
            'event_lat_long' => 'nullable|max:255',
            'new_contact' => 'required|in:"0","1"',
            'contact_id'  => 'required_if:new_contact,0||integer',
            'first_name' => 'required_if:new_contact,1||max:50',
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
            'contact_id.required_if' => 'Contact id is required!',
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
