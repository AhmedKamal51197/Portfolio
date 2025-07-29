<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstegramBroadcast extends Model
{
    use HasFactory;

    protected $table = 'instegram_broadcasts';
    protected $fillable = [
        'title_ar',
        'title_en',
        'all_broadcast_link',
        'banner_title_ar',
        'banner_title_en',
        'banner_description_ar',
        'banner_description_en',
        'broadcast_link',
        'image',
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
        return $this->attributes['title_' . app()->getLocale()];
    }
    public function getBannerTitleAttribute()
    {
        return $this->attributes['banner_title_' . app()->getLocale()];
    }
    public function getBannerDescriptionAttribute()
    {
        return $this->attributes['banner_description_' . app()->getLocale()];
    }
    

}
