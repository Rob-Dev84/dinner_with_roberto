<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostImage extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'path',
        'title',
        'slug',
        'alt',
        'figcaption',
        'position',
    ];

    public function post() {
        return $this->BelongsTo(Post::class);
    }

    
}
