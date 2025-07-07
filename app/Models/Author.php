<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    public $fillable = [
        'title',
        'slug',
        'designation',
        'dob',
        'email', 
        'country', 
        'phone', 
        'description', 
        'author_img', 
        'author_feature', 
        'facebook_id',
        'twitter_id',
        'youtube_id',
        'pinterest_id'
    ];


    function books(){
        return $this->hasMany(Book::class, 'author_id');
    }
}
