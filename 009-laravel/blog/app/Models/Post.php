<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //public $fillable = ['title', 'resumen', 'body'];

    //sin proteger ninguna propiedad
    //public $guarded = [];
    //proteger id
    //public $guarded = ['id'];
    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
