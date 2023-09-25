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
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->integer('nivel')->nullable();
            $table->integer('id_principal')->nullable();           
            $table->timestamps();
            $table->softDeletes();
        });
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT ubicaciones ON');
        DB::table('ubicaciones')->insert(array(
            'id'=>'1',
            'nombre'=>'Guatemala',
            'nivel'=>'1',
            'id_principal'=>NULL           
        ));

        DB::table('ubicaciones')->insert(array(
            'id'=>'2',
            'nombre'=>'Quetzaltenango',
            'nivel'=>'2',
            'id_principal'=>'1'          
        ));

        DB::table('ubicaciones')->insert(array(
            'id'=>'3',
            'nombre'=>'Quetzaltenango',
            'nivel'=>'3',
            'id_principal'=>'2'           
        ));
        DB::unprepared('SELECT 1; SET IDENTITY_INSERT ubicaciones OFF');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
