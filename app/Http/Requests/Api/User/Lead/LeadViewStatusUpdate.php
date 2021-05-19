<?php

namespace App\Http\Requests\Api\User\Lead;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadViewStatusUpdate extends FormRequest
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
            'lead_status_types_id' => 'required|integer|max:100',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Lead id is required!',
            'lead_status_types_id.required' => 'lead status id is required!',
        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'lead_status_types_id' => 'trim|escape|strip_tags',
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
