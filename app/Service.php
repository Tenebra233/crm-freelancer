<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'service_id');
    }
}
