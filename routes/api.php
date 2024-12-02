<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\FondosController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriasController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/actividades',[ActividadesApiController::class,'index'])->name('actividades.index');
Route::post('/actividades',[ActividadesApiController::class,'store'])->name('actividades.store');
Route::delete('/actividades/{actividad}',[ActividadesApiController::class,'destroy'])->name('actividades.destroy');
Route::get('/actividades/{actividad}',[ActividadesApiController::class,'show'])->name('actividades.show');
// Route::get('/actividades/{actividad}/edit',[ActividadesController::class,'edit'])->name('generos.edit')->middleware('auth');;
Route::put('/actividades/{actividad}',[ActividadesApiController::class,'update'])->name('actividades.update');


Route::get('/fondos',[fondosApiController::class,'index'])->name('fondos.index');
Route::post('/fondos',[fondosApiController::class,'store'])->name('fondos.store');
Route::delete('/fondos/{fondo}',[fondosApiController::class,'destroy'])->name('fondos.destroy');
Route::get('/fondos/{fondo}',[fondosApiController::class,'show'])->name('fondos.show');
// Route::get('/fondos/{actividad1}/edit',[fondosController::class,'edit'])->name('fondos.edit')->middleware('auth');;
Route::put('/fondos/{fondo}',[fondosApiController::class,'update'])->name('fondos.update');


Route::apiResource('pagos', PagosApiController::class);


Route::get('/roles',[RolesApiController::class,'index'])->name('roles.index');
Route::get('/roles/{rol}',[RolesApiController::class,'show'])->name('roles.show');
Route::post('/roles',[RolesApiController::class,'store'])->name('roles.store');
Route::delete('/roles/{rol}',[RolesApiController::class,'destroy'])->name('roles.destroy');
// Route::get('/roles/{rol}/edit',[RolesController::class,'edit'])->name('generos.edit')->middleware('auth');;
Route::put('/roles/{rol}',[RolesApiController::class,'update'])->name('roles.update');


Route::apiResource('usuarios', UsuariosApiController::class);
Route::put('usuarios/actualizar-plus/{usuario}', [UsuariosApiController::class, 'plus']);
Route::put('usuarios/cambiar-contrasena/{usuario}', [UsuariosApiController::class, 'password']);
Route::post('/login',[UsuariosApiController::class, 'login']);
Route::put('usuarios/actualizarTodo/{usuario}',[UsuariosApiController::class, 'updateDeTodo']);


Route::apiResource('categorias', CategoriasApiController::class);
