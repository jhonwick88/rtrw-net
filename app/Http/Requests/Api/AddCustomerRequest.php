<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomerRequest extends FormRequest
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
            'name'  => ['required'],
            'adress'  => ['required'],
            'phone'  => ['required'],
            'photo'  => ['sometimes'],
            'extra_price'  => ['sometimes','integer'],
            'discount'  => ['sometimes','integer'],
            'shared_user'  => ['required','integer'],
            'server_id'  => ['required','integer'],
            'network_id'  => ['required','integer'],
            'status'  => ['sometimes'],
        ];
    }
}
