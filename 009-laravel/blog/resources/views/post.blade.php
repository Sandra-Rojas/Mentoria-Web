<!-- codigo html cabecera hoja de estilo se llevo a la plantilla -->
<!-- para que tome esa plantilla se debe hacer une extends de la plantilla padre -->
<!-- luego se debe definir cual es el contenido que sera reemplazado en la plantilla con section -->
    
@extends("layout")
@section("content")
    <p> <a href= "/category/{{$post->category->id}}">
                                {{$post->category->name}}  
        </a>
    </p> 

    <article>
        <p> <?= $post->body ?></p>
    </article>
    <a href="/">Go Back</a>
@endsection