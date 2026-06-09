<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'event_date',
        'time_info',
        'location',
        'type'
    ];
    
    protected $casts = [
        'event_date' => 'date',
    ];
}
