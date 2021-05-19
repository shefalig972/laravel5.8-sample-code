<?php

namespace App\Http\Requests\Api\User\Lead\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadTaskUpdate extends FormRequest
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
            'lead_id' => 'required|max:50',
            'task_due_type' => 'required|max:50',
            'custom_date' => 'date',
            'task_type' => 'required|max:50',
            'detail' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Task id is required!',
            'lead_id.required' => 'Lead id is required!',
            'task_due_type.required' => 'Due type is required!',
            'task_type.required' => 'Task type is required!',
            'detail.required' => 'Note detail is required!',
        ];
    }


    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'lead_id' => 'trim|escape|strip_tags',
            'task_due_type' => 'trim|escape|strip_tags',
            'task_type' => 'trim|escape|strip_tags',
            'detail' => 'capitalize|escape|strip_tags|trim',
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
