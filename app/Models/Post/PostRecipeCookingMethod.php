<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRecipeCookingMethod extends Model
{
    use HasFactory;



    protected $fillable = [
        'name',
    ];
}
