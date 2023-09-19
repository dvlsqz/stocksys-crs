<?php

use App\Http\Controllers\Admin\PanelPrincipalController;
use App\Http\Controllers\Admin\UbicacionController;
use App\Http\Controllers\Admin\InstitucionController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\EscuelaController;

Route::prefix('/admin')->group(function(){
    Route::get('/', [PanelPrincipalController::class, 'getInicio'])->name('panel_principal');

    //Modulo de Ubicaciones
    Route::get('/ubicaciones', [UbicacionController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/ubicacion/registrar', [UbicacionController::class, 'postUbicacionRegistrar'])->name('ubicacion_registrar');    
    Route::get('/ubicacion/{id}/editar', [UbicacionController::class, 'getUbicacionEditar'])->name('ubicacion_editar');
    Route::post('/ubicacion/{id}/editar', [UbicacionController::class, 'postUbicacionEditar'])->name('ubicacion_editar');
    Route::get('/ubicacion/{id}/eliminar', [UbicacionController::class, 'getUbicacionEliminar'])->name('ubicacion_eliminar');
    Route::get('/ubicacion/{id}/listado/n1', [UbicacionController::class, 'getUbicacionListadoN1'])->name('ubicacion_n1');
    Route::post('/ubicacion/n1/registrar', [UbicacionController::class, 'postUbicacionN1Registrar'])->name('ubicacion__n1_registrar');
    Route::get('/ubicacion/{id}/listado/n2', [UbicacionController::class, 'getUbicacionListadoN2'])->name('ubicacion_n2');
    Route::post('/ubicacion/n2/registrar', [UbicacionController::class, 'postUbicacionN2Registrar'])->name('ubicacion_n2_registrar');

    //Modulo de instituciones
    Route::get('/instituciones', [InstitucionController::class, 'getInicio'])->name('instituciones');
    Route::get('/institucion/registrar', [InstitucionController::class, 'getInstitucionRegistrar'])->name('institucion_registrar');  
    Route::post('/institucion/registrar', [InstitucionController::class, 'postInstitucionRegistrar'])->name('institucion_registrar');    
    Route::get('/institucion/{id}/editar', [InstitucionController::class, 'getInstitucionEditar'])->name('institucion_editar');  
    Route::post('/institucion/{id}/editar', [InstitucionController::class, 'postInstitucionEditar'])->name('institucion_editar');
    Route::get('/institucion/{id}/eliminar', [InstitucionController::class, 'getInstitucionEliminar'])->name('institucion_eliminar');

    //Modulo de Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'getInicio'])->name('usuarios');
    Route::get('/usuario/registrar', [UsuarioController::class, 'getUsuarioRegistrar'])->name('usuarios_registrar');
    Route::post('/usuario/registrar', [UsuarioController::class, 'postUsuarioRegistrar'])->name('usuarios_registrar');
    Route::get('/usuario/{id}/editar', [UsuarioController::class, 'getUsuarioEditar'])->name('usuarios_editar');
    Route::post('/usuario/{id}/editar', [UsuarioController::class, 'postUsuarioEditar'])->name('usuarios_editar');
    Route::get('/usuario/{id}/eliminar', [UsuarioController::class, 'getUsuarioEliminar'])->name('usuarios_eliminar');
    Route::get('/usuario/{id}/permisos', [UsuarioController::class, 'getUsuarioPermisos'])->name('usuarios_permisos');
    Route::post('/usuario/{id}/permisos', [UsuarioController::class, 'postUsuarioPermisos'])->name('usuarios_permisos');
    Route::get('/usuario/{id}/rest-contra', [UsuarioController::class, 'getUsuarioRestablecerContra'])->name('usuarios_restablecer_contrasena');
    Route::get('/usuario/{id}/rest-pin', [UsuarioController::class, 'getUsuarioRestablecerPin'])->name('usuarios_restablecer_pin');
    Route::get('/usuario/{id}/suspender', [UsuarioController::class, 'getUsuarioSuspender'])->name('usuarios_suspender');

    //Modulo de escuelas
    Route::get('/escuelas', [EscuelaController::class, 'getInicio'])->name('escuelas');
});