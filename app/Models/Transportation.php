<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;
    protected $fillable =[

        'start_point',
        'destination',
        'travel_date',
        'available_seats',
        'price',
        'type'
    ];


}
