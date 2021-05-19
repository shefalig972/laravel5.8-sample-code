<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactPost extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:50',
            'email' => 'email|max:100',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required!'
        ];
    }


    public function filters()
    {
        return [
            'email' => 'trim|escape|strip_tags',
            'first_name' => 'capitalize|escape|strip_tags|trim',
            'last_name' => 'capitalize|escape|strip_tags|trim',
            'phone_type' => 'capitalize|escape|strip_tags|trim',
            'phone' => 'capitalize|escape|strip_tags|trim',
            'organization' => 'capitalize|escape|strip_tags|trim',
            'title' => 'capitalize|escape|strip_tags|trim',
            'referred_by' => 'capitalize|escape|strip_tags|trim',
            'first_name_information' => 'capitalize|escape|strip_tags|trim',
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
