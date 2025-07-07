<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rolepermission;
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
    ];


    public function user(){
        return $this->hasMany(User::class , 'role_id');
    }

    public function rolepermission(){
        return $this->hasMany(Rolepermission::class , 'role_id');
    }
}
