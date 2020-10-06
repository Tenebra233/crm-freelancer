<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $casts = [
        'date' => 'date'
    ];

    public function orderDetail(){
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
