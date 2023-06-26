<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMethodGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    // public function post() {
    //     return $this->BelongsTo(Post::class);
    // }

    // public function postMethod() {
    //     return $this->BelongsTo(PostMethod::class);
    // }
    
}
