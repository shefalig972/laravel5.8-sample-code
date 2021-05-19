<?php

namespace App\Http\Requests\Api\User\LeadStages;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PositionPost extends FormRequest
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
            'id' => 'required|integer|max:100',
            'position' => 'required|integer|max:50',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Lead Stage id is required!',
            'position.required' => 'Lead stage position is required!',
        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'position' => 'trim|escape|strip_tags',
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
