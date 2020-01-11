<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudante', function (Blueprint $table) {
            $table->unsignedInteger('id_pessoa');
            $table->string('numero_mecanografico');
            $table->string('periodo');
            $table->unsignedInteger('id_curso');          
            $table->foreign('id_pessoa')->references('id')->on('pessoa')->onDelete('cascade'); 
            $table->foreign('id_curso')->references('id')->on('curso')->onDelete('cascade');
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
        Schema::dropIfExists('estudante');
    }
}
