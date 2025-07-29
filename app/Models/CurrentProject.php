<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentProject extends Model
{
    use HasFactory;
    protected $table = 'current_projects';
    protected $fillable = [
        'title_ar',
        'title_en',
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
    


}
