<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'name'=>'required|string|min:3|max:255',
            'email'=>['required','string','email:filter',Rule::unique('users','email')->ignore($user->id)],
            'phone_number'=>'regex:/(09)[0-9]{9}/',
            'is_supperuser'=>'string',
            'is_staff'=>'string'
        ];
    }
}
