<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'img_link',
        'intro',
        'note',
    ];

    public function user() {
        return $this->BelongsTo(User::class);
    }

    public function postIngredients() {
        return $this->hasMany(PostIngredient::class);
    }

    public function postIngredientsGroups() {
        return $this->hasMany(PostIngredientGroup::class);
    }

}
