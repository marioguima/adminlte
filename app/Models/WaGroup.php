<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'segmentations_id', 'name', 'url', 'description', 'seats', 'occuped_seats'
    ];
}
