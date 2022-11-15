<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "plate_number" => $this->plate_number,
            "production_year" => $this->production_year,
            "type" => $this->type,
            "number_of_seats" => $this->number_of_seats,
            "daily_rate" => $this->daily_rate,
            "note" => $this->note,
        ];
    }
}
