<?php

namespace App\Http\Requests\Api\User\Lead\Note;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadNotePost extends FormRequest
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
            'lead_id' => 'required|max:50',
            'detail' => 'required|',
        ];
    }

    public function messages()
    {
        return [
            'lead_id.required' => 'Lead id is required!',
            'detail.required' => 'Note detail is required!',
        ];
    }


    public function filters()
    {
        return [
            'lead_id' => 'trim|escape|strip_tags',
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
