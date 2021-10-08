<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddAdsRequest extends FormRequest
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
            'ads_title' => ['required'],
            'ads_price' => ['required','integer'],
            'ads_type' => ['required'],
            'ads_owner_name' => ['required'],
            'ads_owner_email' => ['required'],
            'ads_owner_phone' => ['required'],
            'ads_address' => ['required'],
            'ads_image_url' => ['required'],
            'ads_link' => ['required'],
            'is_active' => ['required']
        ];
    }
}
