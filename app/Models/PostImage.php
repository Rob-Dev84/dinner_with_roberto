<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'title',
        'alt',
        'figcaption',
        'position',
    ];

    public function post() {
        return $this->BelongsTo(Post::class);
    }

    
}
