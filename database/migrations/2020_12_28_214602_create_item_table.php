<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('titulo');
            $table->string('anexo');
            $table->unsignedInteger('id_trabalho');
            $table->smallInteger('avaliacao')->nullable();
            $table->string('comentario');
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
        Schema::dropIfExists('item');
    }
}
