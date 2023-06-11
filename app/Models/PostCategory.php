<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // public function parent()
    // {
    //     return $this->belongsTo(Postcategory::class, 'parent_id');
    // }

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }



}
