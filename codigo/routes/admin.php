<?php

use App\Http\Controllers\Admin\PanelPrincipalController;
use App\Http\Controllers\Admin\UbicacionController;
use App\Http\Controllers\Admin\InstitucionController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\EscuelaController;
use App\Http\Controllers\Admin\RutaController;
use App\Http\Controllers\Admin\EntregaController;
use App\Http\Controllers\Admin\InsumoController;
use App\Http\Controllers\Admin\RacionController;
use App\Http\Controllers\Admin\SolicitudController;
use App\Http\Controllers\Admin\BitacoraController;
use App\Http\Controllers\Admin\PruebasController;

Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'UserStatus', 'Permissions']],function(){
    Route::get('/', [PanelPrincipalController::class, 'getInicio'])->name('panel_principal');

    //Modulo de Ubicaciones
    Route::get('/ubicaciones', [UbicacionController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/ubicacion/registrar', [UbicacionController::class, 'postUbicacionRegistrar'])->name('ubicacion_registrar');    
    Route::get('/ubicacion/{id}/editar', [UbicacionController::class, 'getUbicacionEditar'])->name('ubicacion_editar');
    Route::post('/ubicacion/{id}/editar', [UbicacionController::class, 'postUbicacionEditar'])->name('ubicacion_editar');
    Route::get('/ubicacion/{id}/eliminar', [UbicacionController::class, 'getUbicacionEliminar'])->name('ubicacion_eliminar');
    Route::get('/ubicacion/{id}/listado/n1', [UbicacionController::class, 'getUbicacionListadoN1'])->name('ubicacion_n1');
    Route::post('/ubicacion/n1/registrar', [UbicacionController::class, 'postUbicacionN1Registrar'])->name('ubicacion_registrar_n1');
    Route::get('/ubicacion/{id}/listado/n2', [UbicacionController::class, 'getUbicacionListadoN2'])->name('ubicacion_n2');
    Route::post('/ubicacion/n2/registrar', [UbicacionController::class, 'postUbicacionN2Registrar'])->name('ubicacion_registrar_n2');
    Route::post('/ubicacion/importar', [UbicacionController::class, 'postUbicacionImportar'])->name('ubicacion_registrar');  

    //Modulo de instituciones
    Route::get('/instituciones', [InstitucionController::class, 'getInicio'])->name('instituciones');
    Route::get('/institucion/registrar', [InstitucionController::class, 'getInstitucionRegistrar'])->name('institucion_registrar');  
    Route::post('/institucion/registrar', [InstitucionController::class, 'postInstitucionRegistrar'])->name('institucion_registrar');    
    Route::get('/institucion/{id}/editar', [InstitucionController::class, 'getInstitucionEditar'])->name('institucion_editar');  
    Route::post('/institucion/{id}/editar', [InstitucionController::class, 'postInstitucionEditar'])->name('institucion_editar');
    Route::get('/institucion/{id}/eliminar', [InstitucionController::class, 'getInstitucionEliminar'])->name('institucion_eliminar');

    //Modulo de Usuarios
    Route::get('/usuarios', [UsuarioController::class, 'getInicio'])->name('usuarios');
    Route::get('/usuario/registrar', [UsuarioController::class, 'getUsuarioRegistrar'])->name('usuario_registrar');
    Route::post('/usuario/registrar', [UsuarioController::class, 'postUsuarioRegistrar'])->name('usuario_registrar');
    Route::get('/usuario/{id}/editar', [UsuarioController::class, 'getUsuarioEditar'])->name('usuario_editar');
    Route::post('/usuario/{id}/editar', [UsuarioController::class, 'postUsuarioEditar'])->name('usuario_editar');
    Route::get('/usuario/{id}/eliminar', [UsuarioController::class, 'getUsuarioEliminar'])->name('usuario_eliminar');
    Route::get('/usuario/{id}/permisos', [UsuarioController::class, 'getUsuarioPermisos'])->name('usuario_permisos');
    Route::post('/usuario/{id}/permisos', [UsuarioController::class, 'postUsuarioPermisos'])->name('usuario_permisos');
    Route::get('/usuario/{id}/rest-contra', [UsuarioController::class, 'getUsuarioRestablecerContra'])->name('usuario_restablecer_contrasena');
    Route::get('/usuario/{id}/rest-pin', [UsuarioController::class, 'getUsuarioRestablecerPin'])->name('usuario_restablecer_pin');
    Route::get('/usuario/{id}/suspender', [UsuarioController::class, 'getUsuarioSuspender'])->name('usuario_suspender');

    //Modulo de escuelas
    Route::get('/escuelas', [EscuelaController::class, 'getInicio'])->name('escuelas');
    Route::get('/escuela/registrar', [EscuelaController::class, 'getEscuelaRegistrar'])->name('escuela_registrar');  
    Route::post('/escuela/registrar', [EscuelaController::class, 'postEscuelaRegistrar'])->name('escuela_registrar');    
    Route::get('/escuela/{id}/editar', [EscuelaController::class, 'getEscuelaEditar'])->name('escuela_editar');  
    Route::post('/escuela/{id}/editar', [EscuelaController::class, 'postEscuelaEditar'])->name('escuela_editar');
    Route::get('/escuela/{id}/eliminar', [EscuelaController::class, 'getEscuelaEliminar'])->name('escuela_eliminar');
    Route::post('/escuela/importar', [EscuelaController::class, 'postEscuelaImportar'])->name('escuela_registrar');  

    //Modulo de rutas
    Route::get('/rutas', [RutaController::class, 'getInicio'])->name('rutas');
    Route::post('/ruta/registrar', [RutaController::class, 'postRutaRegistrar'])->name('ruta_registrar');
    Route::get('/ruta/{id}/eliminar', [RutaController::class, 'getRutaEliminar'])->name('ruta_eliminar');
    Route::get('/ruta/{id}/asignar_escuelas', [RutaController::class, 'getRutaAsignarEscuelas'])->name('ruta_asignar_escuelas');
    Route::post('/ruta/asignar_escuelas', [RutaController::class, 'postRutaAsignarEscuelas'])->name('ruta_asignar_escuelas');
    Route::get('/ruta_asignaciones/{id}/eliminar', [RutaController::class, 'getRutaEliminarEscuelas'])->name('ruta_asignar_escuelas');

    //Modulo de Entregas
    Route::get('/entregas', [EntregaController::class, 'getInicio'])->name('entregas');
    Route::post('/entrega/registrar', [EntregaController::class, 'postEntregaRegistrar'])->name('entrega_registrar');    
    Route::get('/entrega/{id}/editar', [EntregaController::class, 'getEntregaEditar'])->name('entrega_editar');
    Route::post('/entrega/{id}/editar', [EntregaController::class, 'postEntregaEditar'])->name('entrega_editar');
    Route::get('/entrega/{id}/eliminar', [EntregaController::class, 'getEntregaEliminar'])->name('entrega_eliminar');

    //Modulo de Alimentos
    Route::get('/insumos', [InsumoController::class, 'getInicio'])->name('insumos');
    Route::get('/insumo/registrar', [InsumoController::class, 'getInsumoRegistrar'])->name('insumo_registrar');  
    Route::post('/insumo/registrar', [InsumoController::class, 'postInsumoRegistrar'])->name('insumo_registrar');    
    Route::get('/insumo/{id}/editar', [InsumoController::class, 'getInsumoEditar'])->name('insumo_editar');  
    Route::post('/insumo/{id}/editar', [InsumoController::class, 'postInsumoEditar'])->name('insumo_editar');
    Route::get('/insumo/{id}/eliminar', [InsumoController::class, 'getInsumoEliminar'])->name('insumo_eliminar');
    Route::get('/insumo/{id}/pesos', [InsumoController::class, 'getInsumoPesos'])->name('insumo_pesos');
    Route::post('/insumo/pesos', [InsumoController::class, 'postInsumoPesos'])->name('insumo_pesos');

    //Modulo de Raciones
    Route::get('/raciones', [RacionController::class, 'getInicio'])->name('raciones');
    Route::post('/racion/registrar', [RacionController::class, 'postRacionRegistrar'])->name('racion_registrar');    
    Route::get('/racion/{id}/editar', [RacionController::class, 'getRacionEditar'])->name('racion_editar');
    Route::post('/racion/{id}/editar', [RacionController::class, 'postRacionEditar'])->name('racion_editar');
    Route::get('/racion/{id}/eliminar', [RacionController::class, 'getRacionEliminar'])->name('racion_eliminar');
    Route::get('/racion/{id}/alimentos', [RacionController::class, 'getRacionAlimentos'])->name('racion_alimentos');
    Route::post('/racion/alimentos', [RacionController::class, 'postRacionAlimentos'])->name('racion_alimentos');
    Route::get('/racion/alimentos/{id}/eliminar', [RacionController::class, 'getRacionAlimentosEliminar'])->name('racion_alimentos');

    //Modulo de Solicitudes
    Route::get('/solicitudes', [SolicitudController::class, 'getInicio'])->name('solicitudes');
    Route::post('/solicitud/importar', [SolicitudController::class, 'postSolicitudImportar'])->name('solicitudes');
    

    //Reporte de Bitacoras
    Route::get('/bitacoras', [BitacoraController::class, 'getInicio'])->name('bitacoras');

    //Modulo de Pruebas
    Route::get('/pruebas', [PruebasController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/prueba/importar', [PruebasController::class, 'postArchivoImportar'])->name('escuela_registrar');

    
});