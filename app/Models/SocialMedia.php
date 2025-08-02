<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $table = 'social_medias';
    protected $fillable = [
        'facebook_link',
        'instagram_link',
        'whatsApp_link',
        'telegram_link',
        'tictok_link',
        'youtube_link',
        'mail_link',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
