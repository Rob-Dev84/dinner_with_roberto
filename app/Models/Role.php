<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'dscription',
    ];


    //Assuming a role can be taken by multiple users
    public function users()
    {
        return $this->hasMany(User::class);
    }


}
