<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone|min:11|max:11',
            'password' => 'required|min:8|max:25|confirmed',
            'password_confirmation' => 'required|min:8|max:25',
            'status' => 'required'
        ];

    }


    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name not more than 255 characters long',

            'email.required' => 'Email is required',
            'email.unique' => 'This email already exists',

            'phone.required' => 'Phone is required',
            'phone.unique' => 'This phone number already exists',
            'phone.min' => 'Phone number is Invalid',
            'phone.max' => 'Phone number is Invalid',

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
