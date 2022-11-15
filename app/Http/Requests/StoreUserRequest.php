<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
            "first_name" => 'required',
            "last_name" => 'required',
            "country_id" => 'required',
            "passport_number" => 'required|unique:users',
            "phone_number" => 'required',
            "email" => 'required|email|unique:users',
            "note" => 'nullable',
        ];
    }
}
