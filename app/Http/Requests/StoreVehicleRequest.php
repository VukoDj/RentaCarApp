<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreVehicleRequest extends FormRequest
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
            "plate_number" => "required",
            "production_year" => "required",
            "type" => "required",
            "number_of_seats" => "required",
            "daily_rate" => "required",
            "note" => "required",
        ];
    }
}
