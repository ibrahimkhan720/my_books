<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role_permission;
class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'parent_id',
        'sorting',
    ];

    public function childs(){
        return $this->hasMany(Module::class ,'parent_id' , 'id')->orderBy('sorting');
    }

    public function rolepermission(){
        return $this->hasMany(Role_permission::class , 'module_id');
    }
}
