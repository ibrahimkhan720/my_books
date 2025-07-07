<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public $fillable = [
        'fullname',
        'designation',
        'telephone',
        'mobile',
        'email',
        'description',
        'facebook_id',
        'twitter_id',
        'pinterest_id',
        'profile',
        'team_img',
        'status',
    ];
}
