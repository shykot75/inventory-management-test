<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
            'remember_me' => 'nullable'
        ];

    }


    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password should atleast 8 characters',
            'password.max' => 'Password should not more than 25 characters',

        ];
    }

    public function authorize()
    {
        return true;
    }
}
