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
use App\Http\Controllers\Admin\BodegaSocioController;
use App\Http\Controllers\Admin\BodegaPrincipalController;
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

    //Modulo de Raciones
    Route::get('/raciones/{bodega}', [RacionController::class, 'getInicio'])->name('raciones');
    Route::post('/racion/registrar', [RacionController::class, 'postRacionRegistrar'])->name('racion_registrar');    
    Route::get('/racion/{id}/editar', [RacionController::class, 'getRacionEditar'])->name('racion_editar');
    Route::post('/racion/{id}/editar', [RacionController::class, 'postRacionEditar'])->name('racion_editar');
    Route::get('/racion/{id}/eliminar', [RacionController::class, 'getRacionEliminar'])->name('racion_eliminar');
    Route::get('/racion/{id}/alimentos', [RacionController::class, 'getRacionAlimentos'])->name('racion_alimentos');
    Route::post('/racion/alimentos/asignar', [RacionController::class, 'postRacionAlimentos'])->name('racion_alimentos');
    Route::get('/racion/alimentos/{id}/eliminar', [RacionController::class, 'getRacionAlimentosEliminar'])->name('racion_alimentos_eliminar');

    //Modulo de Bodega - Bodega Socio
    Route::get('/bodega_socio/insumos', [BodegaSocioController::class, 'getInsumos'])->name('bodega_socio_insumos');
    Route::post('/bodega_socio/insumo/registrar', [BodegaSocioController::class, 'postInsumoRegistrar'])->name('bodega_socio_insumo_registrar');
    Route::get('/bodega_socio/insumo/ingresos', [BodegaSocioController::class, 'getInsumoIngresos'])->name('bodega_socio_ingresos');
    Route::post('/bodega_socio/insumo/ingresos', [BodegaSocioController::class, 'postInsumoIngresos'])->name('bodega_socio_ingresos');
    Route::get('/bodega_socio/insumo/egresos', [BodegaSocioController::class, 'getInsumoEgresos'])->name('bodega_socio_egresos');
    Route::post('/bodega_socio/insumo/egresos', [BodegaSocioController::class, 'postInsumoEgresos'])->name('bodega_socio_egresos');
    Route::get('/bodega_socio/insumo/{id}/pesos', [BodegaSocioController::class, 'getInsumoPesos'])->name('bodega_socio_insumo_pesos');
    Route::post('/bodega_socio/insumo/pesos', [BodegaSocioController::class, 'postInsumoPesos'])->name('bodega_socio_insumo_pesos');
    Route::get('/bodega_socio/insumo/{id}/editar', [BodegaSocioController::class, 'getInsumoEditar'])->name('bodega_socio_editar');
    Route::get('/bodega_socio/insumo/{id}/eliminar', [BodegaSocioController::class, 'getInsumoEliminar'])->name('bodega_socio_eliminar');        


    //Modulo de Bodega - Bodega Principal
    Route::get('/bodega_principal/insumos', [BodegaPrincipalController::class, 'getInsumos'])->name('bodega_principal_insumos');
    Route::post('/bodega_principal/insumo/registrar', [BodegaPrincipalController::class, 'postInsumoRegistrar'])->name('bodega_principal_insumo_registrar');
    Route::get('/bodega_principal/insumo/ingresos', [BodegaPrincipalController::class, 'getInsumoIngresos'])->name('bodega_principal_ingresos');
    Route::post('/bodega_principal/insumo/ingresos', [BodegaPrincipalController::class, 'postInsumoIngresos'])->name('bodega_principal_ingresos');
    Route::get('/bodega_principal/insumo/egresos', [BodegaPrincipalController::class, 'getInsumoEgresos'])->name('bodega_principal_egresos');
    Route::post('/bodega_principal/insumo/egresos', [BodegaPrincipalController::class, 'postInsumoEgresos'])->name('bodega_principal_egresos');
    Route::get('/bodega_principal/insumo/{id}/pesos', [BodegaPrincipalController::class, 'getInsumoPesos'])->name('bodega_principal_insumo_pesos');
    Route::post('/bodega_principal/insumo/pesos', [BodegaPrincipalController::class, 'postInsumoPesos'])->name('bodega_principal_insumo_pesos');
    Route::get('/bodega_principal/insumo/{id}/editar', [BodegaPrincipalController::class, 'getInsumoEditar'])->name('bodega_principal_editar');
    Route::get('/bodega_principal/insumo/{id}/eliminar', [BodegaPrincipalController::class, 'getInsumoEliminar'])->name('bodega_principal_eliminar');
    


    //Modulo de Solicitudes    
    Route::get('/solicitudes_despachos', [SolicitudController::class, 'getInicio'])->name('solicitudes');
    Route::get('/solicitud_despacho/registrar', [SolicitudController::class, 'getSolicitudRegistrar'])->name('solicitud_registrar');
    Route::post('/solicitud_despacho/registrar', [SolicitudController::class, 'postSolicitudRegistrar'])->name('solicitud_registrar');
    Route::get('/solicitud_despacho/{id}/mostrar', [SolicitudController::class, 'getSolicitudMostrar'])->name('solicitud_mostrar');
    Route::get('/solicitud_despacho/{id}/eliminar', [SolicitudController::class, 'getSolicitudEliminar'])->name('solicitud_eliminar');
    Route::get('/solicitud_despacho/detalles/{id}/eliminar', [SolicitudController::class, 'getSolicitudDetallesEliminar'])->name('solicitud_detalle_eliminar');
    Route::get('/solicitud_despacho/detalles/{id}/registrar', [SolicitudController::class, 'getSolicitudDetallesRegistrar'])->name('solicitud_detalle_registrar');
    Route::post('/solicitud_despacho/detalles/registrar', [SolicitudController::class, 'postSolicitudDetallesRegistrar'])->name('solicitud_detalle_registrar');
    Route::get('/solicitud_despacho/detalles/{id}/editar', [SolicitudController::class, 'getSolicitudDetallesEditar'])->name('solicitud_detalle_editar');
    Route::post('/solicitud_despacho/detalles/{id}/editar', [SolicitudController::class, 'postSolicitudDetallesEditar'])->name('solicitud_detalle_editar');
    Route::get('/solicitud_despacho/{id}/rutas', [SolicitudController::class, 'getSolicitudRutas'])->name('solicitud_rutas');
    Route::get('/solicitud_despacho/{id}/ruta/{idRuta}', [SolicitudController::class, 'getSolicitudRutaDetalle'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/confirmar_ruta/sin_division', [SolicitudController::class,'postSolicitudRutaConfirmar'])->name('solicitud_rutas');
    Route::post('/solicitud_despacho/crear_subruta', [SolicitudController::class,'postSolicitudCrearSubRuta'])->name('solicitud_rutas');
    
    

    //Reporte de Bitacoras
    Route::get('/bitacoras', [BitacoraController::class, 'getInicio'])->name('bitacoras');

    //Modulo de Pruebas
    Route::get('/pruebas', [PruebasController::class, 'getInicio'])->name('ubicaciones');
    Route::post('/prueba/importar', [PruebasController::class, 'postArchivoImportar'])->name('escuela_registrar');

    
});

Route::get('/stocks/api/detalle/escuela/ruta/{idSolicitud}/{idEscuela}',[SolicitudController::class, 'getDetalleEscuela']); 