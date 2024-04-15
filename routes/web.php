<?php

use App\Models\Ambientes;
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
Route::get('noti', function () {
    return view('notificacion');
});
Route::get('listaA', [RegistroAmbientes::class, 'create'])->name('ambientes.create');
//Route::get('listaA', [RegistroAmbientes::class, 'create'])->name('ambientes.create');
Route::delete('listaA', [RegistroAmbientes::class, 'destroy'])->name('ambientes.destroy');
Route::get('/listaA/search', [RegistroAmbientes::class, 'search'])->name('ambientes.search');

















//Einar
Route::get('listaH', function () {
    return view('ListaHorarios');
});

Route::get('listaH', [horaController::class, 'create'])->name('horarios.create');
//Route::delete('/listaH/{id}', [horaController::class, 'destroy'])->name('horarios.destroy');
Route::delete('listaH', [horaController::class, 'destroy'])->name('horarios.destroy');
Route::get('/listaH/search', [horaController::class, 'search'])->name('horarios.search');

//Route::delete('/listaA/{id}', [RegistroController::class, 'destroy']);















// Sara Colque 
Route::get('horarios', function () {
    return view('Horarios');
});
Route::post('horarios', [horaController::class, 'storeh'])->name('storeh');

Route::get('/HO', function () {
    return view('/');
})->name('HO');

Route::get('horarios/create', [horaController::class, 'create'])->name('Horarios.create');
//modificar para el boton xd
Route::get('/listaH/{id}/editar', [horaController::class, 'edit'])->name('horarios.edit'); //inidica donde debe llegar
Route::put('/horarios/{id}', [horaController::class, 'update'])->name('horarios.update');
Route::get('/ruta', 'horaController@metodo')->name('nombre.ruta'); //CAMBIO PARA MODIFICAR
//listado de ambientes
Route::get('/horarios', function () {
    $ambientes = App\Models\Ambientes::all();
    return view('Horarios')->with('ambientes', $ambientes);
});
//GESTIONAR RESERVAS
use App\Http\Controllers\ClienteReservaController;

Route::get('/cliente/reservar/{ambiente_id}', [ClienteReservaController::class, 'mostrarFormularioReserva'])->name('cliente.reservar');

Route::post('/reserva/store', [ClienteReservaController::class, 'store'])->name('reserva.store');







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
