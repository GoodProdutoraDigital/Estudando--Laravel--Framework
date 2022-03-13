<?php

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

/* Importando controller */
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index']);

Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

/* Particiar evento */
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
/* Sair do evento */
Route::DELETE('/events/leave/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');

/* Usando o método store para gravar registros no banco de dados */
Route::post('/events', [EventController::class, 'store']);

/* Usando o método show para consultar registros específicos do banco de dados */
Route::get('/events/{id}', [EventController::class, 'show']);

/* Rotas edit update */
Route::get('/events/edit/{id}', [EventController::class, 'edit'])->middleware('auth');
Route::PUT('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

/* Usando o método destroy para deletar registros do banco de dados
verbo HTTP DELETE */
Route::delete('/events/{id}', [EventController::class, 'destroy'])->middleware('auth');

/* Aula Rotas */
Route::get('/for', function () {

    $nome = 'Pedro';
    $idade = '32';

    $arr = [1,2,3,4,5,6,7,8,9,10];
    $arr2 = ['Charles', 'Matheus', 'Joao', 'Fernando'];

    return view('example', 
    [
        'nome' => $nome, 
        'idade' => $idade,
        'array' => $arr,
        'array2' => $arr2
    ]);

});

/* Params */
Route::get('/params/{id}', function ($id) {
    return view('example2', ['id' => $id]);
});

/* Definindo Params Adicional */
Route::get('/params_adc/{id?}', function ($id = 1) {
    return view('example2', ['id' => $id]);
});

/* null */
Route::get('/params_null/{id?}', function ($id = null) {
    return view('example2', ['id' => $id]);
});

/* Query params */
Route::get('/params_query', function () {
    $busca = request('search');
    return view('example2', ['busca' => $busca]);
});
