<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyVisionMission extends Model
{
    use HasFactory;
    protected $table = 'my_vision_mission';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'icon',
        'type',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function getTitleAttribute()
    {
        return $this->{"title_" . app()->getLocale()};
    }
    public function getDescriptionAttribute()
    {
        return $this->{"description_" . app()->getLocale()};
    }
}
