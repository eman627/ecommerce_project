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
             'Offeres'=>( $this->offeres && (now()->diffInDays($this->offeres->end_at))) ? [
                'offeres'=>$this->offeres,
                'price_offer'=>  $this->price -($this->offeres->percent * $this->price) /100 ,
                'remaining_time'=>  now()->diff($this->offeres->end_at)
             ] :null ,
        ];
    }
}
