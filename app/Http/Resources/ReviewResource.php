<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'feedback'=>$this->feedback,
            'rating'=>$this->rating,
            'user_id'=>$this->user_id,
<<<<<<< HEAD
            'product_id'=>$this->product_id
            
=======
            'product'=>$this->Product

>>>>>>> 2b9ec46aca7b6b8eedd553279f4cc617537e26e7
        ];
    }
}
