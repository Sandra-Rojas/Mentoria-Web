<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //relation hasone, hasmany, belongsTo
    public function posts()
    {
        return $this->hasmany(Post::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
