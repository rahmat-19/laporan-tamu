<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTamuRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => 'required|email:rfc,dns|unique:user_tamus',
            'noHP' => 'required|numeric|unique:user_tamus',
            'perusahaan' => 'required|max:50',
            'keperluan' => 'required',
            'rak' => 'required',
            'images' => 'required',

        ];
    }
}
