<?php

namespace App\Http\Requests\Api\User\Lead\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadTaskView extends FormRequest
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
            'id' => 'required|max:50',
            'lead_id' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Task id is required!',
            'lead_id.required' => 'Lead id is required!'
        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'lead_id' => 'trim|escape|strip_tags'
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
