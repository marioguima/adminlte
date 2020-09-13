<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaigns_id', 'name', 'description',
    ];
}
