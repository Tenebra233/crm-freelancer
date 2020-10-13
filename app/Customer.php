<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $casts = [
        'birth' => 'date'
    ];

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'customer_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
