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






















// Sarita
Route::get('horarios', function () {
    return view('Horarios');
});










//mary
Route::get('listaA', function () {
    return view('listaAmb');
});


//leo
Route::get('registroAmb', function () {
    return view('registroAmb');
});
Route::post('pruebita',[RegistroAmbientes::class,'store'])->name('store');

Route::get('/pruebita', function () {
    return view('listaAmb'); 
})->name('pruebita');

