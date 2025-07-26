<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalAppreciationCard extends Model
{
    use HasFactory;
    protected $table = 'professional_appreciation_cards';
    protected $fillable = [
        'cardable_id',
        'cardable_type',
        'position',
        'description_ar',
        'description_en',
        'icon',
    ];

    public function getDescriptionAttribute()
    {
        return $this->attributes['description_' . app()->getLocale()];
    } 
    public function cardable()
    {
        return $this->morphTo();
    }

}
