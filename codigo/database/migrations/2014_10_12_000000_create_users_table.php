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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
