<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRecipeSeoMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cooking_method',
        'prep_time_minutes',
        'cooking_time_minutes',
        'total_time_minutes',
        'yield',
    ];

    
}
