<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:255',
            'email'=>'required|string|email:filter|unique:users,email',
            'phone_number'=>'regex:/(09)[0-9]{9}/',
            'password'=>'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/|max:255|confirmed',
            'password_confirmation'=>'required',
            'is_supperuser'=>'string',
            'is_staff'=>'string'
        ];
    }
}
