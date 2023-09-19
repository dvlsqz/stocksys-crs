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
            '0' => 'Suspendido',
            '1' => 'Activo',
        ];

        
        if(!is_null($modo)):
            return $estado;
        else:
            return $estado[$id];
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
                    'ubicacion_registrar_n1' => 'Puede agregar nuevas ubicaciones N1.',
                    'ubicacion_editar_n1' => 'Puede editar ubicaciones N1.',
                    'ubicacion_eliminar_n1' => 'Puede eliminar ubicaciones N1.',
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
            'usurios' => [
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
            ]
    

        ];

        return $p;
    }

?>