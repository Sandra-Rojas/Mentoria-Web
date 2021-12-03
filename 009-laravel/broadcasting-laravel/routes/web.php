<?php

use App\Events\OrderStatusUpdated;
use App\Events\MatriculaStatusUpdated;
use Illuminate\Support\Facades\Route;
use \Freshwork\ChileanBundle\Rut;

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

class Order {
    public $id;
    public $product;

    public function __construct($id, $product){
        $this->id = $id;
        $this->product = $product;

    }
}

class Matricula {
    public $rut;
    public $nombre;

    public function __construct($rut, $nombre){
        $this->rut = $rut;
        $this->nombre = $nombre;

    }
}

Route::get('/', function () {
    //con nueva ruta update se elimina de aca creacion de la orden del producto
    //OrderStatusUpdated::dispatch(new Order(106, 'PS5'));

    return view('welcome');
});

//
Route::get('update', function () {
   
    //OrderStatusUpdated::dispatch(new Order(106, 'PS5'));
    //para tarea crear productos con faker
   $faker = Faker\Factory::create();
   //OrderStatusUpdated::dispatch(new Order(rand(), 'PS5'));
   OrderStatusUpdated::dispatch(new Order(rand(), $faker->name));
    return view('welcome');

});

Route::get('matricula', function () {
      
   $faker = Faker\Factory::create();
   MatriculaStatusUpdated::dispatch(new Matricula('12345678-9', 'Mario Flores'));
   MatriculaStatusUpdated::dispatch(new Matricula('213216549', 'Pablo Morales'));

    //composer require freshwork/chilean-bundle
    //forma larga   
//    for($i = 0; $i < 10; $i++)
//     {
//         //generate random number between 1.000.000 and 25.000.000
//         $random_number = rand(1000000, 25000000);

//         //We create a new RUT wihtout verification number (the second paramenter of Rut constructor)
//         $rut = new Rut($random_number);

//         MatriculaStatusUpdated::dispatch(new Matricula($rut->fix()->format(), $faker->name));
//     }

    //forma corta
    for($i = 0; $i < 10; $i++)
    MatriculaStatusUpdated::dispatch(new Matricula(\Freshwork\ChileanBundle\Rut::set(rand(1000000, 25000000))->fix()->format(),
    $faker->name));

    return view('welcome');
});