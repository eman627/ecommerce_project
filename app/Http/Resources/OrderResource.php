<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Order;

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
            'user_id'=>$this->user->id,
            'price'=>$this->price,
            'comment'=>$this->comment,
            'address_state'=>$this->address_state,
            'address_city'=>$this->address_city,
            'address_street'=>$this->address_street,
            'copoun'=>$this->copoun,
            'payment_id'=>$this->payment_id,
            'status'=>$this->status,
<<<<<<< HEAD
            'created_at'=>$this->created_at,
=======
            'name'=>$this->name,
            'phone'=>$this->phone,
>>>>>>> b3bfbee10553a2a5f946a924cfce66ef9b3599cf
            'user'=>[
                'user_id'=>$this->user->id,
                'user_name'=>$this->user->name,
                'user_address'=>$this->user->address,
                'user_phone'=>$this->user->phone,
            ],
             'order_details'=> OrderdetailResource::collection($this->orderdetails),

        ];
    }
}
