<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|string|email|min:3|max:50',
            'password' => 'required|min:4|max:12'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Invalid email!',
            'email.min' => 'Email must have at least :min characters!',
            'email.max' => 'Email can not have more than :max characters!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must have at least :min characters!',
            'password.max' => 'Password can not have more than :max characters!'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['message' => $validator->errors()->first()], 422));
    }
}
