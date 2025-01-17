<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentationGroupsHit extends Model
{
    use HasFactory;

    protected $fillable = [
        'segmentation_id',
        'wa_group_id',
        'ip',
        'iso_code',
        'country',
        'city',
        'state',
        'state_name',
        'postal_code',
        'timezone',
        'continent',
        'currency',
    ];
}
