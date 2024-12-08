<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelData extends Model
{
    use HasFactory;

    // Explicitly specify the table name (optional in this case)
    protected $table = 'travel_data';

    // Define the fillable fields based on your table schema
    protected $fillable = [
        'from',
        'to',
        'type',
        'route',  // Added column
        'best_way',  // Added column
        'available_time',  // Added column
    ];
}

