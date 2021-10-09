<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EstudanteSugestao extends Model
{
    protected $table = 'estudante_sugestao';

    public static function getEstudantesID($id_sugestao){
        return DB::table('estudante_sugestao')
                ->where('id_sugestao', '=', $id_sugestao)
                ->select('id_estudante')
                ->get();
    } 

    public static function getEstudanteSugestaoID($id_sugestao){
        return DB::table('estudante_sugestao')->where('estado',1)->where('id_sugestao',$id_sugestao)->select('id_estudante')->get();
    }
}
