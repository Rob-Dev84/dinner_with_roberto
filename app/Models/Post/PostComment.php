<?php

namespace App\Models\Post;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        // 'cookie_consent_id',
        'notify_on_reply',
        'read',
        'replied',
        'pinned',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PostComment::class, 'parent_id');
    }

}




