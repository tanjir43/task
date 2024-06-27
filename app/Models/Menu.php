<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent','name','name_l','web','web_icon','app_icon','app_icon',
        'note','note_l'
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent','id');
    }

    public function childs()
    {
        return $this->hasMany(Menu::class,'parent','id')->orderBy('id');
    }
}
