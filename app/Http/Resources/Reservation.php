<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class Reservation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "customer" => new User($this->customer),
            'vehicle' => new Vehicle($this->vehicle),
            'date_from' => $this->date_from,
            'pickup_location' => new City($this->pickUpLocation),
            'drop_off_location' => new City($this->dropOffLocation),
            'price' => $this->price,
            'created_at' => $this->created_at
        ];
    }
}
