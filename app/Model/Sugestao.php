<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sugestao extends Model
{
    protected $table = 'sugestao';

    //retorna as sugestões registadas
    public static function getSugestoes($id){
        return DB::table('sugestao')
        ->join('area_aplicacao','area_aplicacao.id','=','sugestao.id_area')
        ->select('sugestao.id','sugestao.tema','area_aplicacao.nome','estado')    
        ->where('proveniencia','=',$id)
        ->orderBy('area_aplicacao.nome')
        ->get();
    }

    //retorna as sugestões registadas
    public static function verSugestao($id){
        return DB::table('sugestao')
        ->join('area_aplicacao','area_aplicacao.id','=','sugestao.id_area')
        ->join('pessoa','pessoa.id','=','sugestao.id_docente')
        ->select('sugestao.id','sugestao.tema','sugestao.descricao','sugestao.proveniencia','area_aplicacao.nome as area','pessoa.nome as docente','estado')    
        ->where('sugestao.id','=',$id)
        ->get();
    }

    //retorna os estudantes envolvidos numa sugestão
    public static function verEnvolventes($idSugestao){
        return DB::table('estudante_sugestao')
        ->join('estudante','estudante_sugestao.id_estudante','=','estudante.id_pessoa')
        ->join('sugestao','estudante_sugestao.id_sugestao','=','sugestao.id')
        ->join('pessoa','pessoa.id','=','estudante.id_pessoa')
        ->join('curso','curso.id','=','estudante.id_curso')
        ->select('pessoa.id as id_pessoa','pessoa.nome','pessoa.bi','curso.nome as nome_curso')    
        ->where('sugestao.id','=',$idSugestao)
        ->where('estudante_sugestao.estado','=',1)
        ->get();
    }

    
}