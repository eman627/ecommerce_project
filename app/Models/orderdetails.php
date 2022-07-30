<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    use HasFactory;
    protected $table="orderdetails";
    protected $fillable = [
        'quantity',
        'order_id',
        'product_id',
    ];
    public function order()
    {
        return $this->belongsTo(order::class,"order_id","id");
    }
    public function product(){
        return $this->belongsTo(Product::class,"product_id","id");
    }
}
