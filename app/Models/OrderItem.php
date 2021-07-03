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
}
