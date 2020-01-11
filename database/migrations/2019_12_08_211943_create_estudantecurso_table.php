<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudantecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantecurso', function (Blueprint $table) {
            $table->primary(['id_estudante', 'id_curso']);
            //$table->unsignedInteger('id_pessoa');
            //$table->unsignedInteger('id_faculdade');
            //$table->foreign('id_estudante')->references('id')->on('estudante')->onDelete('cascade');           
            //$table->foreign('id_curso')->references('id')->on('curso')->onDelete('cascade');
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
        Schema::dropIfExists('estudantecurso');
    }
}
