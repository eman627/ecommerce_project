<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'verified'=>$this->product_verified_at,
            'name'=>$this->name,
            'price'=>$this->price,
            'description'=>$this->description,
            'brand'=>$this->brand,
            'quantity'=>$this->quantity,
            'category_id'=>$this->category_id,
            'image'=>$this->image,
            'user'=>[
                'user_id'=>$this->user->id,
                'user_name'=>$this->user->name,
                // 'user_address'=>$this->user->address,
                // 'user_phone'=>$this->user->phone,
                'role'=>$this->user->Roles->name
            ],
            'Reviews'=> new ReviewCollection ($this->Reviews),
             'Offeres'=>( count($this->offeres)!=0 && (now()->diffInDays($this->offeres[count($this->offeres)-1]->end_at))) ? [
                'offeres'=>$this->offeres[count($this->offeres)-1],
                'price_offer'=>  $this->price -($this->offeres[count($this->offeres)-1]->percent * $this->price) /100 ,
                'remaining_time'=>  now()->diff($this->offeres[count($this->offeres)-1]->end_at)
             ] :null ,

        ];


    }
}
