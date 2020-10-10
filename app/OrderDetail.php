<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function service(){
        return $this->belongsTo(Service::class ,'service_id');
    }

}
