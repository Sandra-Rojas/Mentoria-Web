<?php

use App\Events\OrderStatusUpdated;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    //con nueva ruta update se elimina de aca creacion de la orden del producto
    //OrderStatusUpdated::dispatch(new Order(106, 'PS5'));

    return view('welcome');
});

//
Route::get('update', function () {
    OrderStatusUpdated::dispatch(new Order(106, 'PS5'));
    //para tarea crear productos con faker
    //OrderStatusUpdated::dispatch(new Order(rand(), 'PS5'));

});