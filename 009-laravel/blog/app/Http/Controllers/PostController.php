<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        // return Post::latest('published_at') //Ordenamiento
        // ->filter(request(['search', 'category']))
        // ->paginate(5);//->get();

        return view('posts', [
        //'posts' => Post::all()
        //'posts' => $posts
            'posts' => Post::latest('published_at') //Ordenamiento
                ->filter(request(['search', 'category']))
                ->paginate(6), //get => ejecutar
            'categories' => Category::all(),
            'currentCategory' => 
                request('category') !== null ? Category::where('slug', request('category'))->first() : null,
        ]);
    }

    Public function show(Post $post) {    
        return view('post', [
         'post' => $post, 
        ]);
    }
}
