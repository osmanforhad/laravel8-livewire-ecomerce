<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = "order_items";

    //function for setup relationship with Order table
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //function for setup relationship with products table
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //function for setup relationship with review table
    public function review()
    {

        return $this->hasOne(Review::class, 'order_item_id');
    }
}
