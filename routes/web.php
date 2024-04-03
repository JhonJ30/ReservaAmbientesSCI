<?php

use App\Http\Controllers\horaController;
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
Route::get('listaA', [RegistroAmbientes::class, 'create'])->name('ambientes.create');
Route::delete('/listaA/{id}', [RegistroAmbientes::class, 'destroy'])->name('ambientes.destroy');

//Einar
Route::get('listaH', function () {
    return view('ListaHorarios');
});
Route::get('listaH', [horaController::class, 'create'])->name('horarios.create');
Route::delete('/listaH/{id}', [horaController::class, 'destroy'])->name('horarios.destroy');

//Route::delete('/listaA/{id}', [RegistroController::class, 'destroy']);




















// Sara
Route::get('horarios', function () {
    return view('Horarios');
});
Route::post('horarios', [horaController::class, 'storeh'])->name('storeh');

Route::get('/HO', function () {
    return view('/');
})->name('HO');
/*Route::get('/',[horaController::class, 'storeh'])->name('sara.create');*/
Route::get('horarios/create', [horaController::class, 'create'])->name('Horarios.create');
//modificar para el boton xd
Route::get('/listaH/{id}/editar', [horaController::class, 'edit'])->name('horarios.edit'); //inidica donde debe llegar
/*Route::put('/listaH/{id}', [horaController::class, 'update'])->name('actualizarHorario');*/
/*Route::post('/actualizar-horario/{id}', 'HorarioController@actualizarHorario')->name('actualizarHorario');
Route::get('/obtener-horario/{id}', 'HorarioController@obtenerHorario')->name('obtenerHorario');*/
Route::get('/horarios/editar/{id}', [horaController::class, 'editar'])->name('horarios.editar');
Route::put('/horarios/{id}', [horaController::class, 'update'])->name('horarios.update');
Route::get('/ruta', 'horaController@metodo')->name('nombre.ruta'); //CAMBIO PARA MODIFICAR








//leo
Route::get('registroAmb', function () {
    return view('registroAmb');
});

Route::get('editarAmb', function () {
    return view('editarAmb');
});

Route::post('pruebita', [RegistroAmbientes::class, 'store'])->name('store');

Route::get('/pruebita', function () {
    return view('listaAmb');
})->name('pruebita');

Route::get('success', function () {
    return view('success');
})->name('success');


Route::get('/ambientes/editar/{id}', [RegistroAmbientes::class, 'editar'])->name('ambientes.editar');
Route::put('/ambientes/{id}', [RegistroAmbientes::class, 'update'])->name('ambientes.update');



//jhon
Route::get('client', function () {
    return view('homeUser');
});
Route::get('client/verAmbientes', [RegistroAmbientes::class, 'index']);
Route::get('client/buscarAmbientes', [RegistroAmbientes::class, 'buscar'])->name('ambientes.buscar');
Route::get('client/buscarAmbientesAvanzado', [RegistroAmbientes::class, 'buscarAvanzado']);
Route::get('client/verAmbientes/calendario/{id}', [RegistroAmbientes::class, 'showCalendario']);
