<!-- codigo html cabecera hoja de estilo se llevo a la plantilla -->
<!-- para que tome esa plantilla se debe hacer une extends de la plantilla padre -->
<!-- luego se debe definir cual es el contenido que sera reemplazado en la plantilla con ection -->
    
    @extends("layout")

    @section('banner')
        <h1>El super Blog</h1>
    @endsection
    
    @section("content")
    <!-- probando instruccion if -->
        @if(count($posts) > 0)
        
            @foreach($posts as $post)
            <!-- ?php foreach($posts as $post): ?> -->
                <article>
                    <h1> 
                         <!-- <a href="/post/<?= $post->slug?>"> -->
                         <a href="/post/<?= $post->id?>">
                            <?= $post->title ?>
                        </a>  
                    </h1>    
                    <p><?= $post->resumen ?></p> 
            </article>
            <!-- ?php endforeach; ?> -->
            @endforeach
        @else
                I don't have any posts!
        @endif    
    @endsection

     

