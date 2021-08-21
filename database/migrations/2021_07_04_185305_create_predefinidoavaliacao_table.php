<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefinidoavaliacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefinidoavaliacao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avaliacao');
            $table->string('descricao');
            $table->unsignedInteger('id_departamento');
            $table->timestamps();
            $table->foreign('id_departamento')->references('id')->on('departamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predefinidoavaliacao');
    }
}
