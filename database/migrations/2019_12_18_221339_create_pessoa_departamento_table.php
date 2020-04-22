<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_departamento', function (Blueprint $table) {
            $table->unsignedInteger('id_pessoa');
            $table->unsignedInteger('id_departamento');
            $table->int('tipo',1);
            $table->foreign('id_pessoa')->references('id')->on('pessoa')->onDelete('cascade');           
            $table->foreign('id_departamento')->references('id')->on('departamento')->onDelete('cascade');
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
        Schema::dropIfExists('pessoa_departamento');
    }
}
