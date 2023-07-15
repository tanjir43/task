<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'transaction_type',
        'amount',
        'fee',
        'date',

        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];


    public function createdby():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updatedby():BelongsTo
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function deletedby():BelongsTo
    {
        return $this->belongsTo(User::class,'deleted_by');
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
