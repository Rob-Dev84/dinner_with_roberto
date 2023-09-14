<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'post_id',
        'user_id',
        'post_comment_status_id',
        'user_ip',
        'recipe_rating',
        'name',
        'email',
        'comment',
        'link',
        'cookies_consent',
        'notify_on_reply',
        'pinned',
    ];

    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

}




