<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $casts = [
        'date' => 'datetime'
    ];


}
