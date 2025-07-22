<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'This email is not registered in the system.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.'
        ];
    }
}