<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoafaculadadeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoafaculdade', function (Blueprint $table) {
            $table->unsignedInteger('id_pessoa');
            $table->unsignedInteger('id_faculdade');
            $table->foreign('id_pessoa')->references('id')->on('pessoa');           
            $table->foreign('id_faculdade')->references('id')->on('faculdade');
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
        Schema::dropIfExists('pessoafaculdade');
    }
}
