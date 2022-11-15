<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreReservationRequest extends FormRequest
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
            "customer_id" => "required|exists:users,id",
            "vehicle_id" => "required|exists:vehicles,id",
            "date_from" => "required",
            "date_to" => "required",
            "pickup_location" => "required|exists:cities,id",
            "drop_off_location" => "required|exists:cities,id",
            "price" => "required|gt:0",
        ];
    }
}
