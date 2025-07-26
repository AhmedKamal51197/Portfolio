<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;
    protected $table = 'hero_section';
    protected $fillable = [
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
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
        //return $this->{"title_" . app()->getLocale()};
        return $this->attributes['title_'. app()->getLocale()];
    }
    public function getDescriptionAttribute()
    {
        //return $this->{"description_" . app()->getLocale()};
        
        return $this->attributes['description_'. app()->getLocale()];
    }
    


}
