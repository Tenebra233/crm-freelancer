<?php //

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'date' => 'datetime'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
