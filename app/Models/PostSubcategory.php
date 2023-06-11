<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSubcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'category_id',
        'name',
        'slug',
        'description',
    ];
    
}
