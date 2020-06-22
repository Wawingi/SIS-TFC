<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaAplicacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_aplicacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('visibilidade');
            $table->unsignedInteger('id_departamento');          
            $table->foreign('id_departamento')->references('id')->on('departamento')->onDelete('cascade');   
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_aplicacao');
    }
}
