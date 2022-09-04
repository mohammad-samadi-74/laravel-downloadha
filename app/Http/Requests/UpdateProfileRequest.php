<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
//use App\Http\Requests\Request;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255','min:3'],
            'email' => ['required', 'string', 'email:filter', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'phone_number' => ['nullable', 'regex:/(09)[0-9]{9}/']
        ];
    }
}
