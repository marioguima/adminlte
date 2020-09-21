<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'segmentations_id', 'name', 'url', 'image_path', 'description', 'edit_data', 'send_message', 'seats', 'occuped_seats'
    ];

    public function segmentation()
    {
        return $this->belongsTo(Segmentation::class, 'segmentations_id', 'id');
    }

    public function groupMembers()
    {
        return $this->hasMany(WaGroupInitialMember::class, 'wa_groups_id', 'id' );
    }
}
