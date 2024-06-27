<?php

namespace App\Traits;

use App\Models\User;

trait Blameable
{
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedby()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}