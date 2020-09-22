<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'end',
        'stop_monitoring',
        'description',
    ];

    public function segmentations()
    {
        return $this->hasMany(Segmentation::class, 'campaigns_id', 'id');
    }
}
