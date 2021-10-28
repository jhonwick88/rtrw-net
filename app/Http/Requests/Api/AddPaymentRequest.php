<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddPaymentRequest extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->first();
        $response = response()->json([
            'code' => -1,
            'message' => $errors,
            'data' => null,
        ], 200);
        throw new HttpResponseException($response);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month' => ['required'],
            'year' => ['required'],
            'pay_date' => ['required'],
            'total' => ['required','integer'],
           // 'user_id' => ['required','integer'],
            'payment_method_id' => ['required','integer'],
            'customer_id' => ['required','integer'],
            'status' => ['required'],
        ];
    }
}
