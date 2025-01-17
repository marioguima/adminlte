<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Segmentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'name',
        'description',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function groups()
    {
        return $this->hasMany(WaGroup::class);
    }
}
