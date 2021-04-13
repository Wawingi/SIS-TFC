<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvaPublicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prova_publica', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('nota');
            $table->longText('recomendacao')->nullable();
            $table->unsignedInteger('id_trabalho');
            $table->unsignedInteger('id_nota_informativa');
            $table->timestamps();
            $table->foreign('id_nota_informativa')->references('id')->on('nota_informativa')->onDelete('cascade');
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
        Schema::dropIfExists('prova_publica');
    }
}
