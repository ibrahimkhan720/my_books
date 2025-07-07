<?php
// app/Models/Cart.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Register;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'register_id',
        'quantity',
    ];

    public function book() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function register() {
        return $this->belongsTo(Register::class, 'register_id');
    }


}
