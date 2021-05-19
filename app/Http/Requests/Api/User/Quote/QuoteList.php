<?php

namespace App\Http\Requests\Api\User\Quote;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuoteList extends FormRequest
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
            //
        ];
    }
    public function filters()
    {
        return [
            'id' => 'trim|escape|strip_tags',
            'fields' => 'escape|strip_tags|trim',
            'filter' => 'escape|strip_tags|trim',
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
