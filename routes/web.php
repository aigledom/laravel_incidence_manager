<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\IncidenciasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\OpcionesController;
use App\Http\Controllers\UsuariosController;

//Llama al controlador de idioma
Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

//Llama al controlador de incidencias
Route::middleware('notAuth')->group(function () {
    Route::get('/incidencias/store', [IncidenciasController::class, 'welcome'])->name('incidencias.welcome');
    Route::get('/incidencias/{id}', [IncidenciasController::class, 'show'])->name('incidencias.show');
    Route::get('/incidencias/{id}/edit', [IncidenciasController::class, 'edit'])->name('incidencias.edit');
    Route::put('/incidencias/{id}', [IncidenciasController::class, 'update'])->name('incidencias.update');
    Route::delete('/incidencias/{id}', [IncidenciasController::class, 'destroy'])->name('incidencias.destroy');
    //Llama al controlador de sesión
    Route::get('/admin/logOut', [LoginController::class, 'logout'])->name('admin.logout');
});
Route::get('/', [IncidenciasController::class, 'index'])->name('incidencias.index');
Route::get('/incidencias', [IncidenciasController::class, 'index'])->name('incidencias.index');
Route::get('/incidencias/create', [IncidenciasController::class, 'create'])->name('incidencias.create');
Route::post('/incidencias', [IncidenciasController::class, 'store'])->name('incidencias.store');

Route::middleware('valid')->group(function () {
    //Ruta de los logs
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    //Llama al controlador del administrador para gestionar los campos de incidencias
    Route::get('/opciones', [OpcionesController::class, 'index'])->name('admin.index');
    Route::put('/opciones/updateCampos', [OpcionesController::class, 'updateCampos'])->name('opciones.updateCampos');

    //Controlador de Categorias
    Route::get('categorias', [CategoriasController::class, 'categoriasShow'])->name('categorias.show');
    Route::post('categorias', [CategoriasController::class, 'categoriasStore'])->name('categorias.store');
    Route::get('categorias/create', [CategoriasController::class, 'categoriasCreate'])->name('categorias.create');
    Route::get('categorias/{id}/edit', [CategoriasController::class, 'categoriasEdit'])->name('categorias.edit');
    Route::put('categorias/{id}', [CategoriasController::class, 'categoriasUpdate'])->name('categorias.update');
    Route::delete('categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');

    //Controlador de Empresas
    Route::get('empresas', [EmpresasController::class, 'show'])->name('empresas.show');
    Route::post('empresas', [EmpresasController::class, 'store'])->name('empresas.store');
    Route::get('empresas/create', [EmpresasController::class, 'create'])->name('empresas.create');
    Route::get('empresas/{id}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit');
    Route::put('empresas/{id}', [EmpresasController::class, 'update'])->name('empresas.update');
    Route::delete('empresas/{id}', [EmpresasController::class, 'destroy'])->name('empresas.destroy');

    //Llama al controlador del usuario para gestionarlo
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{usuario}', [UsuariosController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
});

//Ruta de mail
/*Route::get('mail', function () {
    return view('mail')->with([
        'saludo' => 'Hola,',
        'url' => 'https://www.ejemplo.com',
    ]);;
});*/

//Ruta de la política de privacidad
Route::view('/documentacion/politica-privacidad', 'documentacion/politicaPrivacidad')->name('politica_privacidad');
Route::view('/documentacion/aviso-legal', 'documentacion/avisoLegal')->name('aviso_legal');
Route::view('/documentacion/aviso-cookies', 'documentacion/avisoCookies')->name('aviso_cookies');

require __DIR__ . '/auth.php';
