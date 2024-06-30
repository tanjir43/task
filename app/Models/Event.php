<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'for_whom',
        'description',
        'location',
        'from_date',
        'to_date',
        'file',
        'status',
        'user_id',
        'country_id',
        'is_specific',
        'city_id',
        'media_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function userGroups()
    {
        return $this->belongsToMany(UserGroup::class);
    }

    public function userEvents()
    {
        return $this->hasMany(UserEvent::class);
    }
}
