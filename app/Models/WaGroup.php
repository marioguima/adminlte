<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaGroup extends Model
{
    use HasFactory;
    
    protected $appends = [
        'full_image_path'
    ];

    protected $fillable = [
        'segmentations_id',
        'name',
        'image_path',
        'description',
        'edit_data',
        'send_message',
        'seats',
        'occuped_seats',
        'people_left',
        'url',
        'full_image_path',
    ];

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class, 'segmentations_id', 'id');
    }

    public function initialMembers()
    {
        return $this->hasMany(WaGroupInitialMember::class, 'wa_groups_id', 'id');
    }

    public function getFullImagePathAttribute()
    {
        return asset('/public/storage/' . $this->image_path);
    }
}
