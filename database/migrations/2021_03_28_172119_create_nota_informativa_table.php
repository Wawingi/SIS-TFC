<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaInformativaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_informativa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('local');
            $table->string('presidente');
            $table->string('secretario');
            $table->string('vogal_1');
            $table->string('vogal_2');
            $table->unsignedInteger('id_trabalho');
            $table->timestamps();
            $table->foreign('id_trabalho')->references('id')->on('trabalho')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_informativa');
    }
}
