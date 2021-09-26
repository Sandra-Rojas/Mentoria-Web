<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    //relation: hasone, hasMany, belongsTo, belongsToMany
    public function category()
    {
        //nombre clase la primera con mayuscula
        return $this->belongsTo(Category::class);
    }   

    public function user()
    {
        //Post pertenece a un usuario
        return $this->belongsTo(User::class);
    }   

}
