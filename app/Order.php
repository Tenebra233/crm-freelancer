<?php //

namespace App;

use Illuminate\Database\Eloquent\Model;
use Titasgailius\SearchRelations\SearchesRelations;

class Order extends Model
{



    protected $casts = [
        'date' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'order_details', 'order_id', 'service_id')
            ->withPivot(['total', 'vat', 'quantity']);
    }
}
