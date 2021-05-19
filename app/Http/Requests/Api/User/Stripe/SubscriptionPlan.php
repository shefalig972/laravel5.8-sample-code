<?php

namespace App\Http\Requests\Api\User\Stripe;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SubscriptionPlan extends FormRequest
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
            'token' => 'string|required',
            'duration_id' => 'required',
            'plan_id' => 'required',

        ];
    }

    public function filters()
    {
        return [
            'token' => 'trim|escape|strip_tags',
            'duration_id' => 'escape|strip_tags|trim',
            'plan_id' => 'escape|strip_tags|trim'
        ];
    }

    public function messages()
    {
        return [
            'token' => 'trim|escape|strip_tags',
            'duration_id' => 'escape|strip_tags|trim',
            'plan_id' => 'escape|strip_tags|trim'
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
