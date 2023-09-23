<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieConsent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'comment_consent',
        'comment_consent_at',
        'language_consent',
        'language_consent_at',
    ];


    
}
