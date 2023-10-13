<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRecipeSeoMetadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_recipe_cooking_method_id',
        'prep_time_minutes',
        'cooking_time_minutes',
        'total_time_minutes',
        'yield',
    ];


// public function post() {
//     return $this->belongsTo(PostRecipeCookingMethod::class);
// }
    
}
