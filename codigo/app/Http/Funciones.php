<?php
    function obtenerRoles($modo, $id){
        $or = [
            '0' => 'Administrador del Sistema',
            '1' => 'Administrador',
            '2' => 'Encargado (Socio)',
            '3' => 'Bodega (Socio)',
        ];

        if(!is_null($modo)):
            return $or;
        else:
            return $or[$id];
        endif;
    }

    function obtenerTiposInstitucion($modo, $id){
        $ti = [
            '0' => 'Soporte',
            '1' => 'Socio',
            '2' => 'Principal'
        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }


    function obtenerEstadosUsuario($modo, $id){
        $estado = [
            '0' => 'Activo',
            '1' => 'Suspendido',
        ];

        
        if(!is_null($modo)):
            return $estado;
        else:
            return $estado[$id];
        endif;
    }

    function obtenerUnidadesMedidaInsumos($modo, $id){
        $ti = [
            '0' => 'Kilogramos por unidad (Caneca/Saco)',
            '1' => 'Gramos x unidad',
            '2' => 'Libras Netas por Unidad = Kg por unidad x Libras por Kg.',
            '3' => 'Quintales x unidad',
            '4' => 'Peso bruto en quintales (peso neto + caneca metalica)',
            '5' => 'Tonelada Metrica Kg.',
            '6' => 'Unidades por TM',
            '7' => 'Barril',
            '8' => 'Cilindro'

        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerCategoriaInsumos($modo, $id){
        $ti = [
            '0' => 'Alimentos',
            '1' => 'Limpieza'

        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerUnidadesMedidaRaciones($modo, $id){
        $ti = [
            '0' => 'Gramos',
            '1' => 'Kilogramos',
            '2' => 'Libras'
        ];

        if(!is_null($modo)):
            return $ti;
        else:
            return $ti[$id];
        endif;
    }

    function obtenerOpcionesBeneficiarios($modo, $id){
        $ob = [
            '0' => 'Estudiantes',
            '1' => 'Lideres',
            '2' => 'Voluntarios',
            '3' => 'Docentes',
        ];

        if(!is_null($modo)):
            return $ob;
        else:
            return $ob[$id];
        endif;
    }

    function obtenerMeses($modo, $id){
        $m = [
            '1' => 'Enero',
            '2' => 'Febrero',
            '3' => 'Marzo',
            '4' => 'Abril',
            '5' => 'Mayo',
            '6' => 'Junio',
            '7' => 'Julio',
            '8' => 'Agosto',
            '9' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre',
        ];

        if(!is_null($modo)):
            return $m;
        else:
            return $m[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function permisosUsuario(){
        $p = [
            'panel_principal' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo Panel Principal',
                'keys' => [
                    'panel_principal' => 'Puede ver el panel principal.'
                ]
            ],
            'ubicaciones' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Ubicaciones',
                'keys' => [
                    'ubicaciones' => 'Puede ver el listado de ubicaciones.',
                    'ubicacion_registrar' => 'Puede agregar nuevas ubicaciones.',
                    'ubicacion_editar' => 'Puede editar ubicaciones.',
                    'ubicacion_eliminar' => 'Puede eliminar ubicaciones.',
                    'ubicacion_n1' => 'Puede ver el listado de ubicaciones N1.',
                    'ubicacion_registrar_n1' => 'Puede agregar nuevas ubicaciones N1.',
                    'ubicacion_editar_n1' => 'Puede editar ubicaciones N1.',
                    'ubicacion_eliminar_n1' => 'Puede eliminar ubicaciones N1.',
                    'ubicacion_n2' => 'Puede ver el listado de ubicaciones N2.',
                    'ubicacion_registrar_n2' => 'Puede agregar nuevas ubicaciones N2.',
                    'ubicacion_editar_n2' => 'Puede editar ubicaciones N2.',
                    'ubicacion_eliminar_n2' => 'Puede eliminar ubicaciones N2.'                    
                ]
            ],
            'instituciones' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Instituciones',
                'keys' => [
                    'instituciones' => 'Puede ver el listado de instituciones.',
                    'institucion_registrar' => 'Puede agregar nuevas instituciones.',
                    'institucion_editar' => 'Puede editar instituciones.',
                    'institucion_eliminar' => 'Puede eliminar instituciones.'                 
                ]
            ],
            'usuarios' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Usuarios',
                'keys' => [
                    'usuarios' => 'Puede ver el listado de usuarios.',
                    'usuario_registrar' => 'Puede agregar nuevas usuarios.',
                    'usuario_editar' => 'Puede editar usuarios.',
                    'usuario_eliminar' => 'Puede eliminar usuarios.',
                    'usuario_permisos' => 'Puede editar permisos de los usuarios.',
                    'usuario_rest_contra' => 'Puede restablecer la contraseña de los usuarios.',
                    'usuario_rest_pin' => 'Puede restablecer el pin de los usuarios.'                            
                ]
            ],
            'escuelas' => [
                'icon' => '<i class="fas fa-tags"></i>',
                'title' => 'Modulo Escuelas',
                'keys' => [
                    'escuelas' => 'Puede ver el listado de escuelas.',
                    'escuela_registrar' => 'Puede agregar nuevas escuelas.',
                    'escuela_editar' => 'Puede editar escuelas.',
                    'escuela_eliminar' => 'Puede eliminar escuelas.'                           
                ]
            ],
            'rutas' => [
                'icon' => '<i class="fa-solid fa-route"></i>',
                'title' => 'Modulo Rutas',
                'keys' => [
                    'rutas' => 'Puede ver el listado de rutas.',
                    'ruta_registrar' => 'Puede agregar nuevas rutas.',
                    'ruta_asignar_escuelas' => 'Puede asignar escuelas a las rutas.',
                    'ruta_eliminar' => 'Puede eliminar rutas.'                           
                ]
            ],
            'entregas' => [
                'icon' => '<i class="fa-solid fa-people-carry-box"></i>',
                'title' => 'Modulo Entregas',
                'keys' => [
                    'entregas' => 'Puede ver el listado de entregas.',
                    'entrega_registrar' => 'Puede agregar nuevas entregas.',
                    'entrega_editar' => 'Puede editar entregas.',
                    'entrega_eliminar' => 'Puede eliminar entregas.'                 
                ]
            ],
            'insumos' => [
                'icon' => '<i class="fa-solid fa-boxes-stacked"></i>',
                'title' => 'Modulo Insumos',
                'keys' => [
                    'insumos' => 'Puede ver el listado de insumos.',
                    'insumo_registrar' => 'Puede agregar nuevos insumos.',
                    'insumo_editar' => 'Puede editar insumos.',
                    'insumo_eliminar' => 'Puede eliminar insumos.',
                    'insumo_pesos' => 'Puede listar y editar pesos de los insumos.'                            
                ]
            ],
            'raciones' => [
                'icon' => '<i class="fa-solid fa-bowl-rice"></i>',
                'title' => 'Modulo Raciones',
                'keys' => [
                    'raciones' => 'Puede ver el listado de raciones.',
                    'racion_registrar' => 'Puede agregar nuevas raciones.',
                    'racion_editar' => 'Puede editar raciones.',
                    'racion_eliminar' => 'Puede eliminar raciones.',
                    'racion_alimentos' => 'Puede crear, editar y eliminar alimentos que conforman las raciones.',          
                ]
            ],
            'bodegas' => [
                'icon' => '<i class="fa-solid fa-warehouse"></i>',
                'title' => 'Modulo Bodegas',
                'keys' => [
                    'bodega_principal_inventario' => 'Puede ver el inventario de la bodega principal.',
                    'bodega_principal_ingresos' => 'Puede registrar ingresos a la bodega principal.',    
                    'bodega_principal_egresos' => 'Puede registrar egresos a la bodega principal.',  
                    'bodega_socio_insumos' => 'Puede ver el listado de insumos de la bodega socio.',
                    'bodega_socio_ingresos' => 'Puede registrar ingresos a la bodega socio.',    
                    'bodega_socio_egresos' => 'Puede registrar egresos a la bodega socio.',  
                ]
            ],
            'solicitudes' => [
                'icon' => '<i class="fa-solid fa-file-invoice"></i>',
                'title' => 'Modulo Solicitudes',
                'keys' => [
                    'solicitudes' => 'Puede ver el listado de solicitudes.',
                    'solicitud_registrar' => 'Puede agregar nuevas solicitudes.',
                    'solicitud_mostrar' => 'Puede ver los detalles de las solicitudes.',
                    'solicitud_eliminar' => 'Puede eliminar solicitudes.',  
                    'solicitud_detalle_eliminar' => 'Puede eliminar detalles de solicitudes.',   
                    'solicitud_detalle_editar' => 'Puede editar detalles de las solicitudes.', 
                    'solicitud_rutas' => 'Puede visualizar las rutas de las solicitudes',    
                ]
            ],
            'reportes' => [
                'icon' => '<i class="fa-solid fa-box-archive"></i>',
                'title' => 'Modulo Reportes',
                'keys' => [
                    'bitacoras' => 'Puede ver el listado de bitacoras del sistema.',        
                ]
            ],

            
    

        ];

        return $p;
    }

?>