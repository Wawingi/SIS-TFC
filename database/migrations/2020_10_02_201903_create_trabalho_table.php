<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabalhoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabalho', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tema');
            $table->longText('descricao');
            $table->integer('proveniencia');
            $table->integer('estado');
            $table->unsignedInteger('id_area');
            $table->unsignedInteger('id_docente');
            $table->foreign('id_area')->references('id')->on('area_aplicacao')->onDelete('cascade');
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
        Schema::dropIfExists('trabalho');
    }
}
