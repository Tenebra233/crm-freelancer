<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use KirschbaumDevelopment\NovaMail\Traits\Mailable;

class Customer extends Model
{
    use Mailable;

    public function getEmailField(): string
    {
        return 'email';
    }

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
