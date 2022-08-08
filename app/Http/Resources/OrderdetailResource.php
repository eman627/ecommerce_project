<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
class OrderdetailResource extends JsonResource
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
            'product_id'=>$this->product_id,
            'product_quantity'=>$this->quantity,
            'product_data'=>  Product::where('id', '=', $this->product_id)->get()

            // 'product_data'=>ProductResource::collection($this->product),
            //  'order'=>new OrderResource($this->order_id)
        ];
    }
}
