<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerUserRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[0-9]).+$/',
            'image' => 'image|mimes:jpg,png',
        ];
    }
}
