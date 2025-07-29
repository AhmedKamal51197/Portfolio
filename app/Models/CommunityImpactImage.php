<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityImpactImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'community_impact_id',
        'image',
        'position',
    ];
    public function communityImpact()
    {
        return $this->belongsTo(CommunityImpact::class);
    }
    
}
