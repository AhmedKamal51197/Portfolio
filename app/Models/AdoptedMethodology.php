<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptedMethodology extends Model
{
    use HasFactory;

    protected $table = 'adopted_methodologies';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
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
    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    }
    
    public function cards()
    {
        return $this->morphMany(ProfessionalAppreciationCard::class, 'cardable');
    }
}
