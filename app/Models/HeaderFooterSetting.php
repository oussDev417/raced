<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderFooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'horaire_admin',
        'horaire_anim',
        'adresse',
        'email',
        'phone',
        'fb_link',
        'insta_link',
        'linkedin_link',
        'youtube_link',
    ];
}
