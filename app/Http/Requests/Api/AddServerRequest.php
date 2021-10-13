<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AddServerRequest extends FormRequest
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
            'name' => ['required'],
            'location' => ['required'],
            'serial_number' => ['sometimes'],
            'model' => ['sometimes'],
            'activate_date' => ['sometimes'],
            'status' => ['sometimes']
        ];
    }
}
