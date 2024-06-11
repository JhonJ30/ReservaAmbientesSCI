<?php

use App\Models\Ambientes;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\materiaController;
use App\Http\Controllers\horarioController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ambienteController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\reservaController;
use App\Http\Controllers\avisoController;
use App\Http\Controllers\csvController;
use App\Http\Controllers\BackupController;


//general
Route::get('/', [usuarioController::class, 'home'])->name('home');
Route::view('/ayuda', 'ayuda')->name('ayuda');

//login
Route::view('/iniciarSesion', 'iniciarSesion')->name('iniciarSesion');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

//ambientes
Route::view('/registroAmbiente', 'ambientes/registroAmbiente')->name('ambientes.registrar');
Route::post('/ambientes', [ambienteController::class, 'store'])->name('ambientes.store');
Route::get('/listaAmbientes', [ambienteController::class, 'create'])->name('ambientes.create');
Route::get('/buscarAmbiente', [ambienteController::class, 'search'])->name('ambientes.search');
Route::delete('/listaAmbientes', [ambienteController::class, 'destroy'])->name('ambientes.destroy');
Route::get('/ambientes/editar/{id}', [ambienteController::class, 'editar'])->name('ambientes.editar');
Route::put('/ambientes/{id}', [ambienteController::class, 'update'])->name('ambientes.update');

Route::get('/verAmbientes', [ambienteController::class, 'index'])->name('ambientes.index');
Route::get('/buscarAmbientes', [ambienteController::class, 'buscar'])->name('ambientes.buscar');
Route::get('/buscarAmbientesAvanzado', [ambienteController::class, 'buscarAvanzado'])->name('ambientes.buscarAvanzado');
Route::get('/calendario/{id}/{fecha?}', [ambienteController::class, 'showCalendario'])->name('ambientes.calendario');

//horarios
Route::view('/registroHorario', 'horarios/registroHorario')->name('horarios.registrar');
Route::post('/horarios', [horarioController::class, 'store'])->name('horarios.store');
Route::get('/listaHorarios', [horarioController::class, 'create'])->name('horarios.create');
Route::get('/buscarHorarios', [horarioController::class, 'search'])->name('horarios.search');
Route::delete('/listaHorarios', [horarioController::class, 'destroy'])->name('horarios.destroy');
Route::get('/horarios/editar/{id}', [horarioController::class, 'edit'])->name('horarios.edit');
Route::put('/horarios/{id}', [horarioController::class, 'update'])->name('horarios.update');

//materias
Route::view('/registroMateria','materias/registroMateria')->name('materias.registrar');
Route::post('/materias', [materiaController::class, 'store'])->name('materias.store');
Route::get('/listaMaterias', [materiaController::class, 'create'])->name('materias.create');
Route::get('/buscarMaterias', [materiaController::class, 'search'])->name('materias.search');
Route::delete('/listaMaterias', [materiaController::class, 'destroy'])->name('materias.destroy');
Route::post('/materiasCSV', [csvController::class, 'materia'])->name('materias.csv');


Route::get('/materias/editar/{id}', [materiaController::class, 'editar'])->name('materias.editar');
Route::put('/materias/{id}', [materiaController::class, 'update'])->name('materias.update');

//reservas
Route::post('/reservas', [reservaController::class, 'store'])->name('reservas.store');
Route::get('/reservas/{ambiente_id}/{nro_ambiente}', [reservaController::class, 'show'])->name('reservas.show');
Route::delete('/verAmbientes', [reservaController::class, 'destroy'])->name('reservas.destroy');
Route::delete('/', [reservaController::class, 'destroy'])->name('reservas.destroy');

Route::get('/listaReservas', [reservaController::class, 'create'])->name('reservas.create');
Route::get('/listaReservas', [reservaController::class, 'verReserva'])->name('reservas.verReserva');
Route::get('/reserva/informacion/{id}', [reservaController::class, 'informacion'])->name('reservas.informacion');

//editar reserva
Route::get('/editarReserva/{id}', [reservaController::class, 'editar'])->name('editarReserva');
Route::post('/reservas/{id}', [reservaController::class, 'update'])->name('reservas.update');
Route::get('/editarReserva/{id}', [reservaController::class, 'editar'])->name('editarReserva');
Route::put('/reservas/{id}', [reservaController::class, 'update'])->name('reservas.update');

Route::get('/eliminarReserva/{id}', [reservaController::class, 'destroy'])->name('eliminarReserva');

//usuarios
Route::view('/registroUsuario','usuarios/registroUsuario')->name('usuarios.registrar');
Route::post('/usuarios', [usuarioController::class, 'store'])->name('usuarios.store');
Route::get('/listaUsuarios', [usuarioController::class, 'create'])->name('usuarios.create');
Route::get('/buscarUsuarios', [usuarioController::class, 'search'])->name('usuarios.search');
Route::delete('/listaUsuarios', [usuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/usuarios/editar/{id}', [usuarioController::class, 'editar'])->name('usuarios.editar');
Route::put('/usuarios/{id}', [usuarioController::class, 'update'])->name('usuarios.update');
Route::post('/usuariosCSV', [csvController::class, 'usuario'])->name('usuarios.csv');

//notificaciones
Route::get('notificacion', [notificationController::class, 'ObtenerNoti'])->name('notificaciones.ObtenerNoti');
Route::put('/notificaciones/{id}', [notificationController::class, 'update'])->name('notificaciones.update');
Route::post('/notificaciones/store', [notificationController::class, 'store'])->name('notificaciones.store');
Route::post('/notificaciones/Rechazar', [notificationController::class, 'Rechazar'])->name('notificaciones.Rechazar');

//avisos

Route::get('/viewlistAviso', [avisoController::class, 'verAvisos'])->name('avisos.verAvisos');
Route::post('/avisos', [avisoController::class, 'add'])->name('avisos.add');
Route::get('/descargar-archivo/{archivo}', [avisoController::class, 'descargarArchivo'])->name('descargar.archivo');
Route::delete('/viewlistAviso', [avisoController::class, 'eliminar'])->name('avisos.eliminar');
Route::get('/avisos/editar/{id}', [avisoController::class, 'editar'])->name('avisos.editar');
Route::post('/avisos/{id}/update', [avisoController::class, 'update'])->name('avisos.update');
//Route::get('/avisos-actualizar', [avisoController::class, 'actualizar'])->name('avisos.actualizar');


//backups
Route::view('/registrarBackup', 'backups/registrarBackup')->name('backups.registrar');
Route::post('/backups', [BackupController::class, 'store'])->name('backups.store');


/*
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
Route::get('listaR', function () {
    return view('listReser');
});

Route::get('noti', [notificationController::class, 'ObtenerNoti'])->name('notificaciones.ObtenerNoti');

Route::put('/notificaciones/{id}', [notificationController::class, 'update'])->name('notificaciones.update');
Route::get('listaR', [ClienteReservaController::class, 'verReserva'])->name('reserva.verReserva');

Route::post('/notificaciones/store', [notificationController::class, 'store'])->name('notificaciones.store');
Route::post('/notificaciones/Rechazar', [notificationController::class, 'Rechazar'])->name('notificaciones.Rechazar');


















//Einar
Route::get('listaH', function () {
    return view('ListaHorarios');
});

Route::get('listaH', [horaController::class, 'create'])->name('horarios.create');
//Route::delete('/listaH/{id}', [horaController::class, 'destroy'])->name('horarios.destroy');
Route::delete('listaH', [horaController::class, 'destroy'])->name('horarios.destroy');
Route::get('/listaH/search', [horaController::class, 'search'])->name('horarios.search');

Route::delete('listaU', [usuarioController::class, 'destroy'])->name('usuarios.destroy');
Route::delete('listaM', [materiaController::class, 'destroy'])->name('materias.destroy');

Route::get('editarUsu', function () {
    return view('editarUsu');
});
Route::get('/usuarios/editarUsu/{id}', [usuarioController::class, 'editar'])->name('usuarios.editar');
Route::put('/usuarios/{id}', [usuarioController::class, 'update'])->name('usuarios.update');

Route::get('editarMat', function () {
    return view('editarMat');
});
Route::get('/materias/editarMat/{id}', [materiaController::class, 'editar'])->name('materias.editar');
Route::put('/materias/{id}', [materiaController::class, 'update'])->name('materias.update');

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
//use App\Http\Controllers\ClienteReservaController;

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
//para visualizar materias en el combo box

Route::get('docente/create3', [ClienteReservaController::class, 'create3'])->name('ambientes.create3');


Route::delete('docente/create3', [ClienteReservaController::class, 'destroyR'])->name('ambientes.destroyR');

















//jhon
Route::get('client/verAmbientes', [RegistroAmbientes::class, 'index']);
Route::get('client/buscarAmbientes', [RegistroAmbientes::class, 'buscar'])->name('ambientes.buscar');
Route::get('client/buscarAmbientesAvanzado', [RegistroAmbientes::class, 'buscarAvanzado']);
Route::get('client/verAmbientes/calendario/{id}', [RegistroAmbientes::class, 'showCalendario']);


Route::get('registroUsuario', function () {
    $materias = App\Models\Materias::all();
    return view('registroUsuario')->with('materias', $materias);
});

Route::get('listaU', [usuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [usuarioController::class, 'store'])->name('usuarios.store');

Route::get('/listaU/search', [usuarioController::class, 'search'])->name('usuarios.search');


Route::get('registroMateria', function () {
    return view('registroMateria');
});
Route::get('listaM', [materiaController::class, 'create'])->name('materias.create');
Route::post('/materias', [materiaController::class, 'store'])->name('materias.store');

Route::get('/listaM/search', [materiaController::class, 'search'])->name('materias.search');


Route::get('/iniciarSesion', function () {
    $adminCount = User::where('rol', 'Administrador')->count();
    if ($adminCount === 0) {
        $newAdmin = new User();
        $newAdmin->codSis = '2024';
        $newAdmin->rol = 'Administrador';
        $newAdmin->nombre = 'admin';
        $newAdmin->apellido = 'main';
        $newAdmin->email = 'admin@gmail.com';
        $newAdmin->password = bcrypt('2024');
        $newAdmin->save();
    }
    return view('iniciarSesion');
});
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('home');
});

Route::get('/docente', function () {
    return view('homeDocente');
});
*/