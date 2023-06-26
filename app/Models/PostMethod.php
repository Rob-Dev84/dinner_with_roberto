<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'method',
        'method_recipe_card',
    ];


    public function postMethodsGroups() {
        return $this->hasMany(PostMethodGroup::class, 'sd');
    }



}
