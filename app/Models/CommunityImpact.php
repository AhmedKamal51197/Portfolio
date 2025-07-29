<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityImpact extends Model
{
    use HasFactory;
    protected $table = 'community_impacts';
    protected $fillable = [
        'title_ar',
        'title_en',
        'image1',
        'image2',
        'image3',
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
    public function cards()
    {
        return $this->morphMany(ProfessionalAppreciationCard::class, 'cardable');
    }
    public function images()
    {
        return $this->hasMany(CommunityImpactImage::class)->orderBy('position');
    }
}
