<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nombres', 250);
            $table->string('apellidos', 250);
            $table->string('contacto', 40)->nullable();    
            $table->string('correo', 250)->nullable();    
            $table->string('puesto', 250)->nullable();  
            $table->integer('id_institucion');
            $table->string('usuario')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('pin')->nullable();
            $table->integer('rol')->nullable();
            $table->text('permisos')->nullable();
            $table->integer('estado');
            $table->rememberToken();
            $table->timestamps(); 
            $table->softDeletes();            
            
        });

        DB::unprepared('SELECT 1; SET IDENTITY_INSERT users ON');
        DB::table('users')->insert(array(
            'id'=>'1',
            'nombres'=>'Ricardo Daniel',
            'apellidos'=>'Velasquez Quiroa',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>'Encargado de Desarrollo',
            'id_institucion'=>'1',
            'usuario'=>'ricardo.velasquez',
            'password'=>'$2y$10$zXvXYnFeooqc6/DeU.Ful.Joy.G6Rm.2uALNtnvtJjKuIJiE9Beia',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'0',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","alimentos":"true","alimento_registrar":"true","alimento_editar":"true","alimento_eliminar":"true","alimento_pesos":"true","raciones":"true","racion_registrar":"true","racion_editar":"true","racion_eliminar":"true","racion_alimentos":"true","bitacoras":"true"}',
            'estado'=>'0', 
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(),       
        ));

        DB::table('users')->insert(array(
            'id'=>'2',
            'nombres'=>'Usuario',
            'apellidos'=>'Prueba',
            'contacto'=>NULL,
            'correo'=>NULL,
            'puesto'=>'Usuario de Prueba',
            'id_institucion'=>'2',
            'usuario'=>'usuario.prueba',
            'password'=>'$2y$10$zXvXYnFeooqc6/DeU.Ful.Joy.G6Rm.2uALNtnvtJjKuIJiE9Beia',
            'pin'=>'$2y$10$dn5Y0/OEPjqOMn3olJAaVuBKxE5m3USkHkghyj8P3OddHEwbzh1.i',            
            'rol'=>'0',
            'permisos'=>'{"panel_principal":"true","ubicaciones":"true","ubicacion_registrar":"true","ubicacion_editar":"true","ubicacion_eliminar":"true","ubicacion_n1":"true","ubicacion_registrar_n1":"true","ubicacion_editar_n1":"true","ubicacion_eliminar_n1":"true","ubicacion_n2":"true","ubicacion_registrar_n2":"true","ubicacion_editar_n2":"true","ubicacion_eliminar_n2":"true","instituciones":"true","institucion_registrar":"true","institucion_editar":"true","institucion_eliminar":"true","usuarios":"true","usuario_registrar":"true","usuario_editar":"true","usuario_eliminar":"true","usuario_permisos":"true","usuario_rest_contra":"true","usuario_rest_pin":"true","escuelas":"true","escuela_registrar":"true","escuela_editar":"true","escuela_eliminar":"true","rutas":"true","ruta_registrar":"true","ruta_asignar_escuelas":"true","ruta_eliminar":"true","entregas":"true","entrega_registrar":"true","entrega_editar":"true","entrega_eliminar":"true","insumos":"true","insumo_registrar":"true","insumo_editar":"true","insumo_eliminar":"true","insumo_pesos":"true","raciones":"true","racion_registrar":"true","racion_editar":"true","racion_eliminar":"true","racion_alimentos":"true","bodega_principal_inventario":"true","bodega_principal_ingresos":"true","bodega_principal_egresos":"true","bodega_socio_inventario":"true","bodega_socio_ingresos":"true","bodega_socio_egresos":"true","solicitudes":"true","solicitud_iniciar_proceso":"true","solicitud_cargar_datos":"true","solicitud_editar":"true","solicitud_eliminar":"true","bitacoras":"true"}',
            'estado'=>'0',       
            "created_at" =>  \Carbon\Carbon::now(), 
            "updated_at" => \Carbon\Carbon::now(), 
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT users OFF');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
