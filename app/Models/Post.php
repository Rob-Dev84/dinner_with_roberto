<?php

namespace App\Models;

use App\Models\PostMethod;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    // use SoftDeletes;


    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'meta_title',
        'meta_description',
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

    public function postMethods() {
        return $this->hasMany(PostMethod::class);
    }

    public function postMethodsGroups() {
        return $this->hasMany(PostMethodGroup::class);
    }

    public function postImages() {
        return $this->hasMany(PostImage::class);
    }

    public function postCategory() {
        return $this->hasOne(PostCategory::class, 'id');
    }

    public function postSubcategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id')->with('parent');
    }

    public function getPostSubcategoryNameAttribute()
    {
        if ($this->postSubcategory && $this->postSubcategory->parent) {
            return $this->postSubcategory->parent->name;
        }

        return null;
    }
    

}
