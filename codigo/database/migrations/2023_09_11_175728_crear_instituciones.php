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
        Schema::create('instituciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 400); 
            $table->string('direccion', 500);
            $table->integer('nivel');
            $table->integer('id_ubicacion');
            $table->string('encargado', 250)->nullable();
            $table->string('contacto', 40)->nullable();      
            $table->string('correo', 250)->nullable();     
            $table->string('observaciones', 500)->nullable();
            $table->integer('estado');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instituciones');
    }
};
