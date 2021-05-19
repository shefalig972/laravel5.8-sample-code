<?php

namespace App\Http\Requests\Api\User\Invoices;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveTemplateRequest extends FormRequest
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
        $nameRequired = ($this->new_template == 1) ? 'required|' : '';
        return [
            'name' => $nameRequired . 'max:100',
            'description' => 'nullable|max:255',
            'quote_body' => 'nullable',
            'amount_deposit' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Template name is required!',
        ];
    }


    public function filters()
    {
        return [
            'name' => 'trim|escape|strip_tags',
            'description' => 'trim|escape|strip_tags',
            'quote_body' => 'capitalize|escape|strip_tags|trim',
            'amount_deposit' => 'trim|escape|strip_tags'
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
