<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'unit',
        'name',
    ];
    

    public function post() {
        return $this->BelongsTo(Post::class);
    }

    public function postIngredientsGroups() {
        return $this->hasMany(PostIngredientGroup::class, 'id', 'post_ingredient_group_id');
    }

    public function postIngredientsNotGruoped()
    {
        return $this->hasMany(PostIngredientGroup::class, 'id', 'post_ingredient_group_id')->where('post_ingredient_group_id', NULL);
    }


}
