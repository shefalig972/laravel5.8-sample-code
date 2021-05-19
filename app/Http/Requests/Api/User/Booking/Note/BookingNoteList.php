<?php

namespace App\Http\Requests\Api\User\Booking\Note;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookingNoteList extends FormRequest
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
            'booking_id' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'booking_id.required' => 'Booking id is required!',
        ];
    }


    public function filters()
    {
        return [
            'booking_id' => 'trim|escape|strip_tags',
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
