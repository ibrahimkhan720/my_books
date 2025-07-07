<?php
// app/Models/Register.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use App\Models\Cart;
use App\Models\Order;


class Register extends Authenticatable
{
    use Notifiable;

    protected $table = 'registers';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function cart() {
        return $this->hasMany(Cart::class, 'register_id');
    }

     public function order(){
        return $this->hasMany(Order::class ,'register_id');
    }
}


