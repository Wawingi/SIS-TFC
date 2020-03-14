<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curso extends Model
{
    protected $table = 'curso';

    public function pegaCursoId($nome){
        return DB::table('curso')->select('id','nome')->where('nome',$nome)->get();
    }

    //Pega os cursos do departamento a visualizar
    public static function pegaCursoDepartamento($id){
        return DB::table('curso')->select('id','nome')->where('id_departamento',$id)->get();
    }
}
