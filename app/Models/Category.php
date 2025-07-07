<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class Category extends Model
{
    use HasFactory;


    public $fillable = [
        'title',
        'slug',
        'description',
        'status',
    ];

    
    function Book(){
        return $this->hasMany(Category::class, 'category_id');
    }
}
