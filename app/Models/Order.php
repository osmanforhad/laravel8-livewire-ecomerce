<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";

    //function for setup relation with user table
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //function for setup relation with orderItem table
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    //function for setup relation with shipping table
    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    //function for setup relation with transcation table
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
