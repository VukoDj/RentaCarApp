<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!Auth::user()->isModerator()){
            return false;
        } else{
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name" => 'nullable',
            "last_name" => 'nullable',
            "country_id" => 'nullable',
            "passport_number" => 'nullable|unique:users',
            "phone_number" => 'nullable',
            "email" => 'nullable|email|unique:users',
            "note" => 'nullable',
            "role_id" => "nullable"

        ];
    }
}
