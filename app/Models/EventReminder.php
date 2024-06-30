<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventReminder extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'event_id',
        'email',
        'reminder_time',
        'reminder_id',
        'is_sent'
    ];

    public function event() :BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($event) {
            $event->reminder_id = 'EVT-' . str_pad(EventReminder::max('id') + 1, 5, '0', STR_PAD_LEFT);
        });
    }
}
