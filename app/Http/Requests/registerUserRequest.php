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
            'first_name' => 'required|min:1|max:250',
            'second_name' => 'required|min:1|max:250',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:8|max:30|regex:/^(?=.*?[A-Z])(?=.*?[0-9]).+$/',
            'image' => 'nullable|image|mimes:jpeg,png',
        ];
    }
}
