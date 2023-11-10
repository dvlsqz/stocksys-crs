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
        Schema::create('solicitud_detalles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_solicitud');
            $table->date('fecha');
            $table->integer('id_escuela');
            $table->integer('mes_de_solicitud');
            $table->integer('dias_de_solicitud');
            $table->integer('ninas_pre_primaria_a_tercero_primaria');
            $table->integer('ninos_pre_primaria_a_tercero_primaria');
            $table->integer('total_pre_primaria_a_tercero_primaria');
            $table->integer('ninas_cuarto_a_sexto');
            $table->integer('ninos_cuarto_a_sexto');
            $table->integer('total_cuarto_a_sexto');
            $table->integer('total_de_estudiantes');
            $table->integer('total_de_raciones_de_estudiantes');
            $table->integer('total_docentes');
            $table->integer('total_voluntarios');
            $table->integer('total_de_docentes_y_voluntarios');
            $table->integer('total_de_raciones_de_docentes_y_voluntarios');
            $table->integer('total_de_personas');
            $table->integer('total_de_raciones');
            $table->integer('tipo_de_actividad_alimentos');
            $table->integer('numero_de_entrega');
            $table->integer('tipo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_detalles');
    }
};
