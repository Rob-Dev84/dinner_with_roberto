<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'post_id',
    ];


    public function tags()
    {
        return $this->hasMany(Tag::class, 'id', 'tag_id');
    }
}
