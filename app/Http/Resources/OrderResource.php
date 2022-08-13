<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Order;
use DB;
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
            'address_state'=>DB::table('states')->where('id','=',$this->address_state)->get('name'),
            'address_city'=>DB::table('cities')->where('id','=',$this->address_city)->get('name'),
            'address_street'=>$this->address_street,
            'copoun'=>$this->copoun,
            'payment_id'=>$this->payment,
            'status'=>$this->status,

            'created_at'=>$this->created_at,

            'name'=>$this->name,
            'phone'=>$this->phone,

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
