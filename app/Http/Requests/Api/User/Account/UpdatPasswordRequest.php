<?php

namespace App\Http\Requests\Api\User\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatPasswordRequest extends FormRequest
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
            'current_password' => 'required|string|max:100',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Current password is required!',
            'password.required' => 'Password is required!',
            'password_confirmation.required' => 'Confirm Password is required!'
        ];
    }


    public function filters()
    {
        return [

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
