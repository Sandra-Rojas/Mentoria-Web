<?php

use App\Models\Post;
use App\Models\User;
//use Illuminate\Support\Facades\File;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
//biblioteca nueva Yaml: permite leer metadata
//requiere instacion de composer, se ejecuta al mismo nivel de archivo composer (ejec dentro de carpeta blog)
//comando: composer require spatie/yaml-front-matter
//NOTA: en servidor de produccion se hace composer install (se reuiere que mantenga las versiones)
//en servidor local composer update (actualiza versiones a mas nuevas)
//composer.lock se debe subir al servidor de PRD
//use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        //'posts' => Post::with('category')->get()
        //agrega orden, el ultimo en publicar encabeza listado de post
        'posts' => Post::latest('published_at')
        //para que la consulta a la bd realice una precarga, y no consulte uno a uno los uusarios, se agrega arreglo con user
        //with es utilizado sólo cuando se llama estaticamente al modelo
        //    ->with('category')
        //->with(['category', 'user'])
        ->with(['category', 'author'])
            ->get()
        
    ]);
});

Route::get('/post/{post}', function (Post $post) {    
    return view('post', [
     'post' => $post, 
    ]);
});

Route::get('/category/{category:slug}', function (Category $category) {    
    return view('posts', [
     'posts' => $category->posts, 
    ]);
});

Route::get('/author/{author}', function (User $author) {    
    ddd( $author->posts->load(['category', 'author']), );
    return view('posts', [
     //utiliza load para recargar las relations requeridas
     //se utiliza cuando se crea una variable de un modelo   
     //eager loading (load, with)
     //por defecto es lazy loading
     'posts' => $author->posts->load(['category', 'author']), 
    ]);
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {

//     \Illuminate\Support\Facades\DB::listen(function($query){
//         logger($query->sql, $query->bindings);
//     });
    
//     /*se lleva collect al modelo Post*/
//     /***revisar con video*/
//     //sacar cache para no limpiar
//     // $posts = cache()->rememberForever(
//     //     'posts.all', 
//     //     fn () =>Post::all() 
//     // );
//     $posts = Post::all(); 
    

//     return view('posts', [
//         //'posts' => Post::all()
//         //'posts' => $posts
//         'posts' => Post::with('category')->get()
//     ]);

//     //solo para mostrar datos------------
//     //al instalar con composer la biblioteca queda accesible desde cualquier parte del proyecto
//     //YamlFrontMatter::parse toma el contenido del archivo
//     // toma el archivo
//     // $document = YamlFrontMatter::parseFile(
//     //     resource_path('posts/my-first-post.html')
//     // );
//     //ddd($document);//devuelve un array con los campos definidos comometadata en my-first-post.html
//     //con matter lee cada campo definido , titulo, resumen,date, slug
//     //ddd($document->matter('title')); //entrega My first post

//     //
//     //se leeran todos los archivos de la carpeta posts
//     //$files = File::files(resource_path("posts/"));
//     //$documents = [];
//     //$posts = [];

//     //versión con foreach!!
//     //arreglo posee cada uno de los archivos que posee metadata y el contenido
//     /*foreach($files as $file){
//        // $documents[] = YamlFrontMatter::parseFile($file);
//        $document = YamlFrontMatter::parseFile($file);
//        //nueva instancia del modelo y pasa varables al constructoor
//        $posts[] = new Post(
//            $document->title,
//            $document->resumen,
//            $document->date,
//            $document->slug,
//            $document->body()
//        );
//     }
//     ddd($posts); //entrega los archivos con metadas y body
    
//     //lectura de metada o bd debe estar en el modelo y eso enviar a la vista
//     //ir al modelo Post, y crear las variables necesarias para obtener title, resumne, date, slug
//     */

//     //version con array_map
//     //mejorar el codigo de arriba con array_map
//     //array map toma function itera sobre $files y sobre un arreglo $files
//     /*
//     $posts = array_map(function($file) {
//         $document = YamlFrontMatter::parseFile($file);
//         //nueva instancia del modelo y pasa varables al constructoor
//         return new Post(
//             $document->title,
//             $document->resumen,
//             $document->date,
//             $document->slug,
//             $document->body()
//         );    
//     }, $files);
//     */

//     //en laravel existen las collectio
//     //version con collection
//     //collection tiene varios metodos uno es map
//     //tiene ventajas sobre arraymap
//     //NO CREAR VARIABLES que no aportan
//     // una mejora es: si la variable se utiliza sólo para una fin, 
//     //no definirla sino utilizarla directamente
//     //ese concepto es llamado inline, usar variables utilizan mucha memoria
  
//     ////$posts = collect($files)
//     /*
//     $posts = collect(File::files(resource_path("posts/")))
//             ->map(function($file) {
//                 $document = YamlFrontMatter::parseFile($file);
//                 //nueva instancia del modelo y pasa varables al constructoor
//                 return new Post(
//                     $document->title,
//                     $document->resumen,
//                     $document->date,
//                     $document->slug,
//                     $document->body()
//                 );    
//             });
//     */       
    
//     //con las collections se pueden hacer map de mapas
//     /*$posts = collect(File::files(resource_path("posts/")))
//     ->map(function($file){
//         //este return pasa a ser la entrada a la sgte function 
//         //toma el valor de la variable $document
//         return YamlFrontMatter::parseFile($file);
//     })
//     ->map(function($document) {
//         return new Post(
//             $document->title,
//             $document->resumen,
//             $document->date,
//             $document->slug,
//             $document->body()
//         );    
//     });*/

//     //sintaxis de collections con funcion arrow
//     //utilizando clase y constructor
//     /*$posts = collect(File::files(resource_path("posts/")))
//             ->map(function($file){
//                 //este return pasa a ser la entrada a la sgte function 
//                 //toma el valor de la variable $document
//                 return YamlFrontMatter::parseFile($file);
//             })
//             ->map(function($document) {
//                 //crea nueva instancia y ejecuta constructor
//                 //por lo que de document rescata title, resumen ..y se los pasa al constructor
//                 return new Post(
//                     $document->title,
//                     $document->resumen,
//                     $document->date,
//                     $document->slug,
//                     $document->body()
//                 );    
//             });
//     */  
    
//     //sintaxis de collections con funcion arrow
//     //utiliza clase con static, parecido a constructores nombrados
//     /*
//     $posts = collect( File::files(resource_path("posts/")))
//             ->map(fn ($file) => YamlFrontMatter::parseFile($file))
//             //llama a la clase Post y a traves de la funcion createFromDocument
//             //obtiene los valores de title, resumen, date que tiene $document
//             ->map(fn ($document) => Post::createFromDocument($document));
//     */

//     //sintaxis de colecctions con funcion arrow y manejo de cache rememberforever
//     //************************************************************************/
//     //NOTA: al quedar por siempre en memoria, al hacer cambios a la página no se
//     //visualizaran en el navegador
//     //se debe reiniciar la cache manualmente            
//     //por consola ir al proyecto y ejecutar comando:php artisan tinker
//     //luwgo:cache()->forget('posts.all'); donde posts.all es el identificador
//     //*************************************************************************/
     
//    /*oki, se obtiene la pagina con el listado de post desde la cache*/ 
//     /*$posts = cache()->rememberForever('posts.all', function () {
//         return collect( File::files(resource_path("posts/")))
//             ->map(fn ($file) => YamlFrontMatter::parseFile($file))
//             //llama a la clase Post y a traves de la funcion createFromDocument
//             //obtiene los valores de title, resumen, date que tiene $document
//             ->map(fn ($document) => Post::createFromDocument($document));
//    });*/
   

//     //sintaxis de colecctions con funcion arrow y manejo de cache rememberforever con funcion arrow
//     /*$posts = cache()->rememberForever(
//         'posts.all', 
//         fn () =>
//         collect( File::files(resource_path("posts/")))
//             ->map(fn ($file) => YamlFrontMatter::parseFile($file))
//             //llama a la clase Post y a traves de la funcion createFromDocument
//             //obtiene los valores de title, resumen, date que tiene $document
//             ->map(fn ($document) => Post::createFromDocument($document))
//     );*/
//     //ddd($posts);

//     // //traslata codigo arriba
//     // /*se lleva collect al modelo Post*/
//     // /***revisar con video*/
//     // $posts = cache()->rememberForever(
//     //     'posts.all', 
//     //     fn () =>Post::all() 
//     // );

//     // return view('posts', [
//     //     //'posts' => Post::all()
//     //     'posts' => $posts
//     // ]);
// });

// //     Route::get('/', function () {
// //         //los posts aca estan en duro
// //         //return view('posts');
// //         //se pasar la variable $post directamente en el arreglo de la vista
// //         //$posts = Post::all();
// //         //ejecutar ruta 127.0.0.1:8000/post
// //         //dd($posts); //entrega el arreglo con los 3 elementos, pero no entrega el nombre de la pagina, tampoco contenido sino symfony
// //         //ir a la documentacion con symfomy\Component ..se obtiene a getContents
// //         //dd($posts[0]->getContents());//entrega el contenido del primer archivo, pagina html
// //         //por lo que se debe modificar metodo all von getcontents
// //         //luego volver a imprimir el resultado de dd($posts)
// //         // $posts = Post::all();
// //         // ddd($posts); //entregara un array con 3 elemtnos pero con el contenido de cada pagina

// //         //probado el metodo all pasarlo a la vista
// //         return view('posts', [
// //             'posts' => Post::all()
// //         ]);

// //         //ir a la vista (posts.blade.php) hacer foreach de los contenidos de cada pagina y sacar codigo en duro que esta en vista
// // });

// //otra forma es utilizar Post en vez de id
// //Route::get('/post/{post}', function (Post $post) {
// //Route::get('/post/{post:slug}', function (Post $post) {    //se agrega metodo en model getRouteKeyName por lo que ya no es requerido:slug

//     Route::get('/post/{post}', function (Post $post) {    
//     return view('post', [
//      'post' => $post, 
//     ]);
// });


// Route::get('/category/{category:slug}', function (Category $category) {    
//     return view('posts', [
//      'posts' => $category->posts, 
//     ]);
// });

// //reemplaza slug por id, ya que se implementa por bd los blogs, title, resumen, body en tb blogs
// Route::get('/post/{post}', function ($id) {
//     return view('post', [
//      'post' => Post::findOrFail($id), //si no encuentra registro entregara una excepcion con instruccion findOrFail
//     ]);
// });

// //al implementar la pagina blog con bd para recstar los diferentes blog con id=1 etc
// //se modifican las rutas de $slug por $id
// //y se elimina el control de caracteres extraños ya que se obtiene los valores de bd
// Route::get('/post/{post}', function ($slug) {
//     //se puede colocar la instrucción directamente, sin necesidad de utilizar una variable $post, 
//      //ya que con esa variable no se hará nada más, a esto se le llama inline
//     //$post = Post::find($slug);
//     return view('post', [
//      //'post' => $post,   
//      'post' => Post::find($slug), //se agrega el modelo Post con metodo find
//     ]);

//     //el codigo existente de obtener ruta, de definir cache se movio a Post.php metodo find
// })->where('post', '[A-Za-z\-_]+'); //con esto carga bien la pagina e impide que ingresen a la url carcateres extraños



//cuando la ruta sea post, retorna vista post
// Route::get('/post', function () {
//     return view('post');
// });

//1.probar el paso de parametro, variable prueba, luego variable post
//a la vista post (post.blade.php)
//2.Rescatar el contenido de la pag my-first-post.html con istrucc file_get_contents
//y pasarsela a variable 'post' =>
//usar _DIR_ : rescata ruta hasta donde está actualmente posicionado, osea hasta routes
// Route::get('/post', function () {
//     //return __DIR__;
//     return view('post', [
//        // 'prueba' => 'Esta es una prueba'
//        // 'post' => 'Esta es una prueba'
//        'post' => file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html'),
//     ]);
// });

//slug rescata la porcion de URL que identifica una pagina (parte dinámica)
//para http://127.0.0.1:8000/post/my-first-post devolverá: my-first-post
//slug {post} y luego pasar esa porcion de url a la funcion en el parametro $slug
//para probar return en nabegador escribir:http://127.0.0.1:8000/post/my-first-post
//entregara $slug=my-first-post
// Route::get('/post/{post}', function ($slug) {
//     return $slug;
//     return view('post', [
//        'post' => file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html'),
//     ]);
// });

//helper para depuración: dd y ddd
//dd: lanza el mensaje y detiene la ejecución del sistema
//probar con escribir:http://127.0.0.1:8000/post/my-first-post
//dd($slug)= tambien entregara my-first-post en negro con letras verdes
//ddd() =dump, died, and debug, entrega una pagina con los valores

// Route::get('/post/{post}', function ($slug) {
//     //dump and died
//     //dd($slug);
//     //dd(print_r($_REQUEST, TRUE));//imprime array vacio, no sirve
//     //dd($_SERVER);//entregara array con los valores de server, document_root, http_host, etc etc
//     //dump, died, and debug
//     ddd($_SERVER); //entrega una página y contenido de impresión
//     return view('post', [
//        'post' => file_get_contents(__DIR__ . '/../resources/posts/my-first-post.html'),
//     ]);
// });

//ahora el slug que obtiene la parte dinamica de ruta se debe se debe pasar al resto de la ruta
//aun probar con http://127.0.0.1:8000/post/my-first-post
//problema aun no se puede ir a la my-first-post desde el blog principal, el que tiene los 3 link a las paginas
// Route::get('/post/{post}', function ($slug) {
//         return view('post', [
//          //comprobando la ruta , y que cargue pag, esta oki   
//          //  'post' => file_get_contents('/var/www/segic/mentoria-web/009-laravel/blog/resources/posts/my-first-post.html'),
//          //recordar usar doble cremila cuando concatena una variable !! :)
//          'post' => file_get_contents(__DIR__ . "/../resources/posts/$slug.html"),
//         ]);
//     });

//Expresiones Regulares
//eencontar un patrón en un texto, para hacer por ej, validaciones
//https://regex101.com/ (editor de expres reguls en linea)
//ejemplo buscar expres regulares en los sgtes string
// http://127.0.1:8000/post/my-third-post
// http://127.0.1:8000/post/blabla
// https://127.0.1:8000/post/usach
//  \d  = detecta todos los nros 1
//  \d{3} = detecta 3 nros juntoos 127
// .  = cualquier caracter, para referirse al . se debe \.
// \d{3}\.\d\.\d\.\d  = 127.0.0.1
// para capturar, un grupo de caracteres encerrar en parentesis
//  (\d{3}\.\d\.\d\.\d) es decir se obtiene donde hace match
// [A-Za-z]  = buscar letras 
// [A-Za-z]:  = toma p: y s:
//  [A-Za-z]+: = toma 1 o mas letras y luego dos puntos = tomaria http: y https:
//  /https?    = puede o no existir el ultimo caracter, tome todos http y https

//Expresion regular
//validar slug (ruta dinamica)
//con where primer parametro nombre de lo que se quiere validar, segundo patrón
//aun probar con http://127.0.0.1:8000/post/my-first-post
// Route::get('/post/{post}', function ($slug) {
//      $path= __DIR__ . "/../resources/posts/$slug.html";   
//     if(!file_exists($path)) {
//          //abort(404);
//          return redirect('/');
//      }
//     return view('post', [
//      'post' => file_get_contents($path),
//     ]);
// //})->where('post', '[A-Za-z]'); //con esto data not found 404 la ruta tiene guion
// })->where('post', '[A-Za-z\-_]+'); //con esto carga bien la pagina e impide que ingresen a la url carcateres extraños

//tipo de Constraint: validar url ingresada con expresones regulares (regular expresion constrains, constrains routes laravel. laravel.com)
//laravel ya tiene metodos creados. pero estos no sirven ya que url tiene -
//})->whereAlpha('post'); //solo letras
//})->whereAlphaNumeric('post'); //letras y numeros


// //Laravel, catching guardar contenido en memoria, puede ser una pagina, una consulta a una bd
// //ejemplo el blog se guardara en memoria, y cada 5 seg se actualizará
// //con php puro utilizar memcache, pero en laravel existe helper (function llama cache())
// //ver en documentación, cache laravel
// //sintaxix que se utilizara: 
// //primero se da un indice unico, 
// //segundo se especifica numero de segundos en que el contenido será guardado
// // y por ultimo la funcion que sera utilizada cuando se refresque el contenido
// //cuando se utiliza callback para pasar parametros 
// //que no son pasados por remember como es el caso de $path
// //se debe utilizar la instrucción use
// Route::get('/post/{post}', function ($slug) {
//      $path= __DIR__ . "/../resources/posts/$slug.html";   
//     if(!file_exists($path)) {
//          //abort(404);
//          return redirect('/');
//      }

//     // //cache()->remember("post.{$slug}", 5, function(){//esto no sirve se debe utilizar use para que reconozca la variable $path
//     // $post = cache()->remember("post.{$slug}", 5, function() use($path){    
//     //     //probar con 127.0.0.1:8000/post/my-first-post
//     //     //se observa al actualizar la pag: resultado= string(17) "file_get_contents"
//     //     //se actualiza nuevamente y no entrega mensaje
//     //     // luego de actualizar alguns veces más aparece el resultado. es decir el mensaje= string(17) "file_get_contents"
//     //     // esto es porque el cahe se vencio, ya no ejecuta lo que tiene en memoria, cada 5 seg se ejecutara la funcion y traera el contenido, e indica el mensaje
//     //     // el intervalo de seg 1 a 4 mostrara lo que esta en memoria
//     //     //esto es utilizado para sitios que tiene alta demanda 
//     //     var_dump('file_get_contents');    
//     //     return file_get_contents($path);
//     // });

//     //la cantidad de seg , se puede obtener de otro helper llamado now
//     //cantidad de minutos de dias, para utilizar en cache, tiempo en que el contenido de la pag esta en cache
//     //now()->addMinutes(52);
//     //now()->addDays(3);
//     //now()->addHours(24);
//     //UTILIZANDO funcion arrow o flecha:
//     $post = cache()->remember("post.{$slug}", 5, fn() => file_get_contents($path));    
//     //$post = cache()->remember("post.{$slug}", now()->addHours(24), fn() => file_get_contents($path));    

//     return view('post', [
//      'post' => file_get_contents($path),
//     ]);
// //})->where('post', '[A-Za-z]'); //con esto data not found 404 la ruta tiene guion
// })->where('post', '[A-Za-z\-_]+'); //con esto carga bien la pagina e impide que ingresen a la url carcateres extraños

// //hasta aqui se esta trabajando con modelo MVC
// //las rutas estan ocupando un callback para procesar una ruta determinada.
// //pero mas adelnate se vera que para cada ruta respondera a una accion del controlador
// //modelo deben estar reglas de negocio, obtener contenido de algo, consulta a bd
// //controlador, redirigir pagina
// //por lo que mucha de esta funcionalidad se llevara a modelo a Post.php




////////////////////////////////////////////////////////////////////
// Route::get('/', fn () => view('posts'));
// Route::get('/post', fn () => view('post'));

//llamada con arrow, mas actual
//Route::get('/', fn () => view('welcome'));
//Route::get('/', fn () => 'Hola Segic');
//Route::get('/', fn () => ['id' => 7, 'url'=> 'http:\\www.segic.cl']);

