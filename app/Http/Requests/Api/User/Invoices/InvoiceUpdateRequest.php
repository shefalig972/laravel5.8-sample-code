<?php

namespace App\Http\Requests\Api\User\Invoices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class InvoiceUpdateRequest extends FormRequest
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
            'save_draft'=>'required|in:"0","1"',
            'service_type_id' => 'required_if:save_draft,0|integer',
            'invoice_body' => 'nullable',
            'amount_deposit' => 'nullable',
            'internal_notes' => 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Invoice id is required!',
            'service_type_id.required' =>  'Interested In is required!',

        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'service_type_id' => 'trim|escape|strip_tags',
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
