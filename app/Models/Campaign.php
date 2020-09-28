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
        'start_monitoring',
        'stop_monitoring',
        'description',
    ];

    public function segmentations()
    {
        return $this->hasMany(Segmentation::class, 'campaigns_id', 'id');
    }

    // public function messages()
    // {
    //     return $this->hasMany(CampaignMessage::class, 'campaigns_id', 'id');
    // }
    public function messages()
    {
        return $this->belongsToMany(Message::class)->withTimestamps()
            ->withPivot(
                'shot',
                'scheduler_date',
                'quantity',
                'unit',
                'trigger',
                'moment',
            )
            ->orderBy('scheduler_date');
    }
}
