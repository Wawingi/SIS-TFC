<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredefinidoavaliacaoItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predefinidoavaliacao_item', function (Blueprint $table) {
            $table->unsignedInteger('id_predefinidoavaliacao');
            $table->unsignedInteger('id_item');
            $table->foreign('id_predefinidoavaliacao')->references('id')->on('predefinidoavaliacao')->onDelete('cascade');
            $table->foreign('id_item')->references('id')->on('item')->onDelete('cascade');
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
        Schema::dropIfExists('predefinidoavaliacao_item');
    }
}
