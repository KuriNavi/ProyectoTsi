<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\CategoriasController;
use Illuminate\Http\Request;



route::middleware('auth')->group(function(){
    route::get('/',[HomeController::class,"index"])->name('home.index');
    route::get('/usuarios/logout',[UsuariosController::class,"logout"])->name('usuarios.logout');
    route::post('/actividades', [ActividadesController::class, "store"])->name('actividades.store');
    route::get('/actividades/index', [ActividadesController::class, "index"])->name('actividades.index');
    
    



});


route::get('/login',[HomeController::class,"login"])->name('login');
route::post('/usuarios/login',[UsuariosController::class,"login"])->name('usuarios.login');
route::post('/usuarios', [UsuariosController::class,"store"])->name('usuarios.store');

