<?php
namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException; 
use Illuminate\Support\Facades\File;
//biblioteca nueva Yaml: permite leer metadata
//requiere instacion de composer, se ejecuta al mismo nivel de archivo composer (ejec dentro de carpeta blog)
//comando: composer require spatie/yaml-front-matter
//NOTA: en servidor de produccion se hace composer install (se reuiere que mantenga las versiones)
//en servidor local composer update (actualiza versiones a mas nuevas)
//composer.lock se debe subir al servidor de PRD
use Spatie\YamlFrontMatter\YamlFrontMatter;

//se utilizara esta clase sólo como contenedor, no se extenderá de ninguna otra clase
class Post{

    public string $title;
    public string $resumen;
    public string $date;
    public string $slug;
    public string $body;
 
    //utilizado para web.php cuando en collection  ->map(function($document) { y se hace el return new Post(
    public function __construct($title, $resumen, $date, $slug, $body )
    {
        $this->title = $title;
        $this->resumen = $resumen;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }

    //parecido a constructores nombrados
    public static function createFromDocument($document)
    {
       return new self(
            $document->title,
            $document->resumen,
            $document->date,
            $document->slug,
            $document->body()
        );
    }

    //deberia ir a resource/posts y recorrer las 3 paginas html y entregar el contenido
    public static function all()
    {

        //return collect([]); //sólo para probar @if de posts.blade.php, recordar borrar cache, por consola!

        return collect( File::files(resource_path("posts/")))
            ->map(fn ($file) => YamlFrontMatter::parseFile($file))
            //llama a la clase Post y a traves de la funcion createFromDocument
            //obtiene los valores de title, resumen, date que tiene $document
            ->map(fn ($document) => Post::createFromDocument($document));

        /***retorno de contenido con array_map es reemplazado por collect*******/
       /*
        $files = File::files(resource_path("posts/"));
        return array_map(fn ($file) => $file->getContents(), $files);
        */
        //*******************************************/

        //////////////////////////////////////////////
        // collect( File::files(resource_path("posts/")))
        // ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        // ->map(fn ($document) => Post::createFromDocument($document))

        //laravel clase File:entrega todos los archivos
        //Laravel patron de diseño Facade
        //al llamar a facade se obtiene una instancia del componenete
        //obtiene info de los archivos, que no es el nombre tampoco el contenido
        //return File::files(resource_path("posts/"));
        
        /*
        $files = File::files(resource_path("posts/"));
        */

        //se utiliza getContents para obtener el contenido de las paginas
        //array_map, toma una lista y genera una nueva lista a la cual se le aplica un callback
        //callback es function que recibira cada elemento se le llamara $file
        //la lista seria $files
        //y se devolvera $file->getContents, es decir el contenido de cada pagina

        //funcion normal
        // return array_map(function($file){
        //     return $file->getContents();
        // }, $files);
        
        //funcion arrow
        /*
        return array_map(fn ($file) => $file->getContents(), $files);
        */    
        //recordar que en javascript
        //files.map(file => file.getContents())
    }

    public static function find($slug)
    {   
        //cache()->remember("indice", "caducidad", "callback => lo que vamos a guardar");
        //indice=> "post.my-first-post"
        //return cache()->remember("post.{$slug}", 1000, fn() => static::all()->firstWhere('slug', $slug));
        return cache()->remember("post.{$slug}", now()->addDays(1), fn() => static::all()->firstWhere('slug', $slug));

        //Se puede acceder al metodo que esta en la misma clase con static::
        //ddd(static::all);

        //$posts= static::all();
        
        //$post= static::all()->firstWhere('slug', $slug);
        //return $post;
        //ddd($posts->firstWhere('slug', $slug));

        /* 
        if (!file_exists($path = resource_path("posts/{$slug}.html"))){    
            throw new ModelNotFoundException();
        }
        return cache()->remember("post.{$slug}", 1000, fn() => file_get_contents($path));
        */
        

        /******************************** */
        //helper: resource_path
        //esta ruta era valida cuando este codigo estaba en web.php
        //laravel tiene un helper para rescatar ruta de la carpeta resource: resource_path
        // en carpeta resource esta carpeta posts y luego las paginas html
        //Nota existen otros helpers para encontrar path de carpetas importantes, app_path, config_path, database_path etc
        //$path = __DIR__ . "/../resources/posts/$slug.html";
        //$path= resource_path("posts/{$slug}.html");

        //if (!file_exists($path)){

        /*    
        if (!file_exists($path = resource_path("posts/{$slug}.html"))){    
        */    
            //abort(404); 
            //redirect no debe estar en el modelo, debe estar en el controller
            //return redirec('/');
            //por lo que si no existe el archivo se puede generar una excepcion
            //exepcion basica de php
            //throw new \Exception();
            //exception de laravel
        /*    
            throw new ModelNotFoundException();
        }
        */

        //helper cache
        // $post = cache()->remember("post.{$slug}", 5, function() use ($path) {
        //     var_dump('file_get_contents');
        //     return file_get_contents($path);
        // });
    
        //helper now
        //now()->addMinutes(52);
        //now()->addDays(3);
        //now()->addHour(24);
    
        //con function normal
        //NOTA:cuando se utiliza callback para pasar parametros 
        //que no son pasados por remember como es el caso de parametro de $path
        //se debe utilizar la instrucción use
        // $post = cache()->remember("post.{$slug}", 5, function() use($path){    
        //     var_dump('file_get_contents');    
        //     return file_get_contents($path);
        //  });

        //con func arrow 
        //dura 5 seg en cache (contenido de la pagina) pasado los 5 ejecuta la function y refresca el contenido de la pagina
        //$post = cache()->remember("post.{$slug}", 5, fn() => file_get_contents($path));

        /*
        return cache()->remember("post.{$slug}", 1000, fn() => file_get_contents($path));
        */

        //$post = cache()->remember("post.{$slug}", now()->addDays(3), fn() => file_get_contents($path));
       
        //el return de vieW no va aca , va en controller
    
    }
}