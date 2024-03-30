<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroAmbientes;
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
    return view('home');
});
//mary
Route::get('listaA', function () {
    return view('listaAmb');
});
Route::get('listaA',[RegistroAmbientes::class, 'create'])->name('ambientes.create');





















// Sarita
Route::get('horarios', function () {
    return view('Horarios');
});













//leo
Route::get('registroAmb', function () {
    return view('registroAmb');
});

Route::get('editarAmb', function () {
    return view('editarAmb');
});

Route::post('pruebita',[RegistroAmbientes::class,'store'])->name('store');

Route::get('/pruebita', function () {
    return view('listaAmb'); 
})->name('pruebita');

Route::get('success', function () {
    return view('success');
})->name('success');


Route::get('/ambientes/editar/{id}', [RegistroAmbientes::class, 'editar'])->name('ambientes.editar');
Route::put('/ambientes/{id}', [RegistroAmbientes::class, 'update'])->name('ambientes.update');

