<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->hasMany(MessageItem::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_messages', 'message_id', 'campaign_id');
    }
}
