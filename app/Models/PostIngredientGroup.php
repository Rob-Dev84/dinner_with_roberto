<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostIngredientGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function post() {
        return $this->BelongsTo(Post::class);
    }

    public function postIngredient() {
        return $this->BelongsTo(PostIngredient::class);
    }

    // public function postIngredientsGroups() {
    //     return $this->hasMany(PostIngredientGroup::class, 'id', 'post_ingredient_group_id');
    // }
}
