<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudanteSugestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudante_sugestao', function (Blueprint $table) {
            $table->unsignedInteger('id_estudante');
            $table->unsignedInteger('id_sugestao');
            $table->integer('estado');
            $table->foreign('id_estudante')->references('id_pessoa')->on('estudante')->onDelete('cascade');           
            $table->foreign('id_sugestao')->references('id')->on('sugestao')->onDelete('cascade');
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
        Schema::dropIfExists('estudante_sugestao');
    }
}
