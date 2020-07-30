<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    protected $table = 'curso';
    use SoftDeletes;

    public function pegaCursoId($nome){
        return DB::table('curso')->select('id','nome')->where('nome',$nome)->get();
    }

    //Pega os cursos do departamento a visualizar
    public static function pegaCursoDepartamento($id,$isDeleted){
        if($isDeleted==0){
            return DB::table('curso')
                    ->select('id','nome')
                    ->whereNull('deleted_at')
                    ->where('id_departamento',$id)
                    ->get();
        }else if($isDeleted==1){
            return DB::table('curso')
                    ->select('id','nome')
                    ->whereNotNull('deleted_at')
                    ->where('id_departamento',$id)
                    ->get();
        }
    }
}
