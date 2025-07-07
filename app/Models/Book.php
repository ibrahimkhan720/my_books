<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\Author;
use App\Models\Orderitem;
class Book extends Model
{
    use HasFactory;
    public $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'availability',
        'price',
        'rating',
        'publisher',
        'country_of_publisher',
        'isbn',
        'isbn_10',
        'audience',
        'format',
        'language',
        'total_pages',
        'downloaded',
        'edition_number',
        'recommended',
        'description',
        'book_img',
        'book_upload',
        'status',
    ];

     function author(){
        return $this->belongsTo(Author::class, 'author_id');
    }

      function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cart(){
        return $this->HasMany(cart::class , 'book_id');
    }

     public function orderitem(){
        return $this->HasMany(orderitem::class , 'book_id');
    }
}
