<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_details', 'service_id', 'order_id');
    }
}
