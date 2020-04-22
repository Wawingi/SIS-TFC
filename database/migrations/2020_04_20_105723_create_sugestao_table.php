<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSugestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sugestao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tema');
            $table->longText('descricao');
            $table->integer('estado');
            $table->integer('visibilidade');
            $table->unsignedInteger('id_area');
            $table->unsignedInteger('id_departamento'); 
            $table->unsignedInteger('id_docente');                   
            $table->foreign('id_area')->references('id')->on('area_aplicacao')->onDelete('cascade');
            $table->foreign('id_departamento')->references('id')->on('departamento')->onDelete('cascade'); 
            $table->foreign('id_docente')->references('id_pessoa')->on('docente')->onDelete('cascade');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sugestao');
    }
}
