<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefesa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('avaliacao');
            $table->smallInteger('tipo');
            $table->longText('recomendacao');
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
        Schema::dropIfExists('predefesa');
    }
}
