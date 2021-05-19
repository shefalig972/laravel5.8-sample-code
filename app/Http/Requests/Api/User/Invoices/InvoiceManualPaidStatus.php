<?php

namespace App\Http\Requests\Api\User\Invoices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceManualPaidStatus extends FormRequest
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
            'id' => 'required|max:50',
            'paid_by' => 'required|max:100',
            'amount_paid' => 'required',
            'paid_on' => 'required|date_format:Y-m-d'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Invoice id is required!',
            'paid_by.required' => 'Please select how this invoice is paid!',
            'amount_paid.required' => 'Amount Paid cannot be null',
            
        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'paid_by' => 'escape|strip_tags|trim',
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
