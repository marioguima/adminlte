<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class naousar_CampaignMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'campaign_id',
        'message_id',
        'shot',
        'scheduler_date',
        'quantity',
        'unit',
        'trigger',
        'moment',
    ];

    // public function messages()
    // {
    //     return $this->hasMany(Message::class,  'message_id', 'id');
    // }
}
