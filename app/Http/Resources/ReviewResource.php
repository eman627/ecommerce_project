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
<<<<<<< HEAD
            'user_name'=>$this->user->name,
            'product_name'=>$this->Product->name
=======
            'user_id'=>$this->user_id,
<<<<<<< HEAD
            'product_id'=>$this->product_id
            
=======
            'product'=>$this->Product
>>>>>>> 3e78f062ad0a3a5a92b33cd6aa3a6c0c06526315

>>>>>>> 2b9ec46aca7b6b8eedd553279f4cc617537e26e7
        ];
    }
}
