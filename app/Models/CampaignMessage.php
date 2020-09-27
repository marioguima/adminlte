<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaigns_id',
        'messages_id',
        'shot',
        'scheduler_date',
        'quantity',
        'unit',
        'trigger',
        'moment',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class,  'messages_id', 'id');
    }
}
