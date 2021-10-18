<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

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
