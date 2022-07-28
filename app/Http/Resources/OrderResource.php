<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'price'=>$this->price,
            'comment'=>$this->comment,
            'address_state'=>$this->address_state,
            'address_city'=>$this->address_city,
            'address_street'=>$this->address_street,
            'user_id'=>$this->user_id,
            'copoun'=>$this->copoun,
            'payment_id'=>$this->payment_id,
            'status'=>$this->status


        ];
    }
}
