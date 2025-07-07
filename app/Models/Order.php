<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\register;
use App\Models\Orderitem;
use App\Models\Countory;
class Order extends Model
{
    use HasFactory;

  protected $fillable = [
    'register_id',
    'name',
    'email',
    'phone',
    'address',
    'city',
    'country_id',
    'zipcode',
    'subtotal',
    'tax',
    'shipping',
    'total_amount',
    'status',
];

    public function register(){
        return $this->belongsTo(register::class ,'register_id');
    }

        public function country(){
        return $this->belongsTo(Countory::class ,'country_id');
    }

     public function orderitem(){
        return $this->HasMany(orderitem::class ,'order_id');
    }
}

