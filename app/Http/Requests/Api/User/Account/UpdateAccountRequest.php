<?php

namespace App\Http\Requests\Api\User\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAccountRequest extends FormRequest
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
            'first_name' => 'nullable|max:50',
            'last_name' => 'nullable|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|max:20',
            'business_owner' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required!',
            'last_name.required' => 'Last name is required!',
            'email.required' => 'Email is required!',
        ];
    }


    public function filters()
    {
        return [
            'email' => 'trim|escape|strip_tags',
            'first_name' => 'capitalize|escape|strip_tags|trim',
            'last_name' => 'capitalize|escape|strip_tags|trim',
            'phone' => 'capitalize|escape|strip_tags|trim',
            'password' => 'trim',
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
