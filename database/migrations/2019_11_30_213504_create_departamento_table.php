<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome')->unique();
            $table->string('chefe_departamento');
            $table->string('email')->unique;
            $table->integer('telefone')->unique;
            $table->integer('tipo');
            $table->unsignedInteger('id_faculdade');
            $table->foreign('id_faculdade')->references('id')->on('faculdade')->onDelete('cascade');
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
        Schema::dropIfExists('departamento');
    }
}
