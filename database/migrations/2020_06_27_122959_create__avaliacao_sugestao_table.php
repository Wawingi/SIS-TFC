<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaoSugestaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacao_sugestao', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->unsignedInteger('id_sugestao');          
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
        Schema::dropIfExists('avaliacao_sugestao');
    }
}
