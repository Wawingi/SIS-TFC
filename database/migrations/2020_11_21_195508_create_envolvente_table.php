<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvolventeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envolvente', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_trabalho');
            $table->unsignedInteger('id_estudante');
            $table->foreign('id_trabalho')->references('id')->on('trabalho')->onDelete('cascade');
            $table->foreign('id_estudante')->references('id_pessoa')->on('estudante')->onDelete('cascade');
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
        Schema::dropIfExists('envolvente');
    }
}
