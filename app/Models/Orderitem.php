<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Book;
class Orderitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'quantity',
        'price'
    ];

    public function order(){
        return $this->belongsTo(order::class , 'order_id');
    }

     public function book(){
        return $this->belongsTo(Book::class , 'book_id');
    }
}
