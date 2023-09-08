<?php

namespace App\Models;

use App\Models\PostMethod;
use App\Models\Post\PostComment;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post\PostCommentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    // use SoftDeletes;


    protected $fillable = [
        'category_id',
        'title',
        'subtitle',
        'slug',
        'meta_title',
        'meta_description',
        'intro',
        'description',
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

    // public function postMethod() {
    //     return $this->hasOne(PostMethod::class);
    // }

    public function postMethodsGroups() {
        return $this->hasMany(PostMethodGroup::class);
    }

    public function postMethodsRecipe()
    {
        return $this->hasManyThrough(
            PostMethod::class, // Target model
            PostMethodGroup::class, // Intermediate model
            'post_id', // Foreign key on intermediate model
            'post_method_group_id', // Foreign key on target model
            'id', // Local key on source model
            'id' // Local key on intermediate model
        );
    }

    public function getMethodParagraphs()//Here $this->postMethods access to the postMethods() method above
    {
        return explode("\n", $this->postMethods->first()->method);
    }

    public function getMethodRecipeCardParagraphs()//This will be called when methods are not grouped
    {
        return explode("\n", $this->postMethods->first()->method_recipe_card);
    }

    public function getGroupedMethodRecipeCardParagraphs()
    {
        
        $paragraphs = [];

        foreach ($this->postMethods as $postMethod) {
            $groupId = $postMethod->post_method_group_id;
            $paragraphs[$groupId] = explode("\n", $postMethod->method_recipe_card);
        }
        
        return $paragraphs;
    }

    public function hasNonGroupedMethods()//check if we have not grouped methods //TODO: use this function on post edit method(e.g. exlamation mark)
    {
        foreach ($this->postMethods as $postMethod) {
            if (is_null($postMethod->post_method_group_id)) {
                return true;
            }
        }
        return false;
    }


    public function getIntroParagraphs()
    {
        return explode("\n", $this->intro);
    }
    

    public function postImages() {
        return $this->hasMany(PostImage::class);
    }

    public function postCategory() {
        return $this->hasOne(PostCategory::class, 'id');
    }

    public function postSubcategory() {
        return $this->hasOne(PostSubcategory::class);
    }

    public function postTags() {
        return $this->hasManyThrough(
            PostTag::class,//Final table
            Tag::class,//middle table
            
            // 'post_id',//Foreign key post_tags table
            // 'id',// Local key on tags table (we must do that because it'll pick 'post_tag_id' instead)

            'id', // Foreign key on the intermediate model (PostTag table)
            'post_id', // Foreign key on the target model (tags table)
            'id', // Local key on the source model (posts table)
            'id' // Local key on the intermediate model (PostTag table)
        );
    }

    // public function getNoteParagraphs()
    // {
    //     return explode("\n", $this->note);
    // }

    public function getNoteParagraphs()//This will be called when methods are not grouped
    {
        return explode("\n", $this->note);
    }

    

    // public function postTags2() {
    //     return $this->hasMany(PostTag::class, 'post_id');
    // }

    

    // public function postSubcategory() {
    //     return $this->hasOneThrough(
    //         PostSubcategory::class,
    //         PostCategory::class,
    //         // 'id', // Foreign key on PostCategory table
    //         'id', // Foreign key on PostSubcategory table
    //         'category_id', // Local key on Post table
    //         // 'id' // Local key on PostCategory table
    //     );
    // }
    


    // public function postSubcategory()
    // {
    //     return $this->belongsTo(PostCategory::class, 'category_id')->with('parent');
    // }

    // public function getPostSubcategoryNameAttribute()
    // {
    //     if ($this->postSubcategory && $this->postSubcategory->parent) {
    //         return $this->postSubcategory->parent->name;
    //     }

    //     return null;
    // }

    public function postComments() {
        return $this->hasManyThrough(
            PostComment::class,//Final table
            PostCommentStatus::class,//middle table
           
            'id', // Foreign key on the intermediate model (PostComment table)
            'post_id', // Foreign key on the target model (PostCommentStatus table)
            'id', // Local key on the source model (PostCommentStatus table)
            'id' // Local key on the intermediate model (PostComment table)
        );
    }
    

}
