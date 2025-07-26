<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalAppreciation extends Model
{
    use HasFactory;
    protected $table = 'professional_appreciation';
    protected $fillable = [
        'title_ar',
        'title_en',
        'position',
        'description_ar',
        'description_en',
        'icon',
    ];
    protected $appends = [
        'position_name',
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
    //get position name
    public function getPositionNameAttribute()
    {
        $positions = [
            1 => __('first card'),
            2 => __('second card'),
            3 => __('third card'),
        ];
        return $positions[$this->position] ?? __('unknown position');
    }
}
