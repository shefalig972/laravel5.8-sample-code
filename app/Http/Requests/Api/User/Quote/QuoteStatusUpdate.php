<?php

namespace App\Http\Requests\Api\User\Quote;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuoteStatusUpdate extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|max:100',
            'status' => 'required|in:"revision","accept","reject","view"',            
            'revision' => 'required_if:status,revision',
            'accept_signatue' => 'required_if:status,accept|max:255',
            'reject_reason' => 'required_if:status,reject|max:255'            
        ];
    }

    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'revision' => 'escape|strip_tags|trim',
            'accept_signatue' => 'escape|strip_tags|trim',
            'reject_reason' => 'escape|strip_tags|trim'
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
