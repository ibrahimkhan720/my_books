<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Countory extends Model
{
    use HasFactory;

    protected  $Fillable = [
        'name',
    ];


    public function order(){
        return $this->HasMany(Order::class , 'country_id');
    }


}
