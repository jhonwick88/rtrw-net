<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddCoinRequest extends FormRequest
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
            'name' => 'required',
            'logo' => ['required', 'file'],
            'symbol' => 'required',
            'network_id' => 'required',
            'contract_address' => 'required',
            'description' => 'required',
            'website_link' => 'required',
            'telegram_link' => 'required',
            'twitter_link' => 'required',            
        ];
    }
}
