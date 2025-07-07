<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role_permission;
use App\Models\Module;

class Rolepermission extends Model
{
    use HasFactory;
    protected $table = 'rolepermissions';
    protected $fillable = [
            'role_id',
            'module_id',
            'pview',
            'pcreate',
            'pedit',
             'pdelete',
    ];

    public function role(){
        return $this->belongsTo(Role::class , 'role_id');
    }

    public function module(){
        return  $this->belongsTo(module::class , 'module_id');
    }
}
