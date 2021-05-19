<?php

namespace App\Http\Requests\Api\User\Invoices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceSendToCustomerRequest extends FormRequest
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
            'email_to' => 'required_if:quote_status_type_id,2|max:255',
            'email_from' => 'required_if:quote_status_type_id,2|max:255',
            'email_subject' => 'required_if:quote_status_type_id,2|max:255',
            'email_description' => 'required_if:quote_status_type_id,2',
            'invoice_status_type_id' => 'required|integer|between:1,2'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Invoice id is required!',
            'email_to.required' => 'Email to is required!',
            'email_from.required' => 'Email from is required!',
            'email_subject.required' => 'Email subject is required!',
            'email_description.required' => 'Email description is required!',
            'quote_status_type_id.required' => 'Invoice status is required!',
        ];
    }


    public function filters()
    {
        return [];
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
