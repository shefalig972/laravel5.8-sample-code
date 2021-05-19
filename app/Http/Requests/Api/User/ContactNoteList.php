<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactNoteList extends FormRequest
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
            'contact_id' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'contact_id.required' => 'Contact id is required!',
        ];
    }


    public function filters()
    {
        return [
            'contact_id' => 'trim|escape|strip_tags',
            'limit' => 'trim|escape|strip_tags',
            'offset' => 'trim|escape|strip_tags',
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
