<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
    ];

    // public function post() {
    //     return $this->BelongsTo(Post::class);
    // }



}
