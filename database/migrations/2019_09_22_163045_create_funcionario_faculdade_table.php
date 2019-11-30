<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuncionarioFaculdadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario_faculdade', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_pessoa');
            $table->string('funcao');
            $table->foreign('id_pessoa')->references('id')->on('pessoa');           
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
        Schema::dropIfExists('funcionario_faculdade');
    }
}
