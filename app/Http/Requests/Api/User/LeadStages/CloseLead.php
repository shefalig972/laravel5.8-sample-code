<?php

namespace App\Http\Requests\Api\User\LeadStages;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CloseLead extends FormRequest
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
            'completed' => 'required|boolean',
            'lead_id' => 'required|max:50',
            'amount' => 'nullable',
            'lead_lost_reason_id' => 'nullable|integer',
            'create_task' => 'required|boolean',
            'task_due_type' => 'nullable|max:50',
            'task_type' => 'nullable|max:50',
            'custom_date' => 'nullable|date',
            'detail' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'completed.required' => 'Won/Lost is required!',
            'lead_id.required' => 'Lead id is required!',
            'task_due_type.required' => 'Due type is required!',
            'detail.required' => 'task detail is required!',
        ];
    }


    public function filters()
    {
        return [
            'completed.required' => 'trim|escape|strip_tags',
            'amount' => 'trim|escape|strip_tags',
            'lead_lost_reason_id' => 'trim|escape|strip_tags',
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
