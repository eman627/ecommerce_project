<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'brand',
        'quantity',
        'image',
        'category_id',
        'user_id'


    ];
    public function orderdetails(){
        return $this->hasMany(orderdetails::class,"product_id","id");
    }
    public function category(){
        return $this->belongsTo(category::class,"category_id","id");
    }
    public function User(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function Reviews(){
        return $this->hasMany(Review::class,"product_id","id");
    }
    public function offeres()
    {
        return $this->hasMany(Offer::class,'product_id','id');
    }
    public function cart()
    {
        return $this->hasOne(Cart::class,'product_id','id');
    }

}
