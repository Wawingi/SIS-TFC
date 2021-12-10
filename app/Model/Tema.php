<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tema extends Model
{
    protected $table = 'trabalho';

    //retorna os temas registados em desenvolvimento de um departamento
    public static function getTemas($id_departamento)
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('docente', 'docente.id_pessoa', '=', 'trabalho.id_docente')
            ->join('pessoa', 'pessoa.id', '=', 'docente.id_pessoa')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            ->select('trabalho.id', 'trabalho.tema', 'area_aplicacao.nome', 'pessoa.nome as orientador')
            ->where('departamento.id',$id_departamento)
            ->where('trabalho.estado',1)
            ->orderBy('area_aplicacao.nome')
            ->groupBy('trabalho.id')
            ->get();
    }

    //retorna os temas ou trabalhos defendidos de um departamento
    public static function getTemasDefendidos($id_departamento)
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            ->join('prova_publica', 'prova_publica.id_trabalho', '=', 'trabalho.id')
            ->select('trabalho.id', 'trabalho.tema', 'area_aplicacao.nome','prova_publica.nota')
            ->where('departamento.id',$id_departamento)
            ->where('trabalho.estado',2)
            ->orderBy('area_aplicacao.nome')
            //->groupBy('trabalho.id')
            ->distinct('trabalho.id')
            ->get();
    }

    //retorna um trabalho defendido
    public static function getTema($id)
    {
         return DB::table('trabalho')
             ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
             ->join('pessoa', 'pessoa.id', '=', 'trabalho.id_docente')
             ->select('trabalho.id', 'trabalho.tema', 'trabalho.descricao','trabalho.recomendacao', 'trabalho.proveniencia', 'trabalho.created_at', 'area_aplicacao.nome as area', 'pessoa.nome as docente', 'estado')
             ->where('trabalho.id', '=', $id)
             ->first();
    }

    //retorna os temas registados de um determinado orientador
    public static function getTemasOrientador($id_pessoa)
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('docente', 'docente.id_pessoa', '=', 'trabalho.id_docente')
            ->join('pessoa', 'pessoa.id', '=', 'docente.id_pessoa')
            ->select('trabalho.id', 'trabalho.tema','trabalho.estado','area_aplicacao.nome', 'pessoa.nome as orientador')
            ->where('trabalho.id_docente',$id_pessoa)
            ->orderBy('area_aplicacao.nome')
            ->get();
    }

    //retorna um tema
    public static function getTrabalhoDefendido($id)
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('pessoa', 'pessoa.id', '=', 'trabalho.id_docente')
            ->join('prova_publica', 'prova_publica.id_trabalho', '=', 'trabalho.id')
            ->join('nota_informativa','nota_informativa.id_trabalho','=','trabalho.id')
            ->select('trabalho.id', 'trabalho.tema', 'trabalho.descricao','trabalho.recomendacao','area_aplicacao.nome as area','pessoa.nome as docente','prova_publica.nota','prova_publica.created_at','nota_informativa.local','nota_informativa.presidente','nota_informativa.secretario','vogal_1','vogal_2')
            ->where('trabalho.id', '=', $id)
            ->where('trabalho.estado', '=', 2)
            ->first();
    }

    //retorna os estudantes envolvidos num tema
    public static function getEnvolventes($idTrabalho)
    {
        return DB::table('envolvente')
            ->join('estudante', 'envolvente.id_estudante', '=', 'estudante.id_pessoa')
            ->join('trabalho', 'envolvente.id_trabalho', '=', 'trabalho.id')
            ->join('pessoa', 'pessoa.id', '=', 'estudante.id_pessoa')
            ->join('curso', 'curso.id', '=', 'estudante.id_curso')
            ->select('pessoa.id as pessoa_id','pessoa.nome', 'pessoa.bi', 'curso.nome as nome_curso')
            ->where('trabalho.id', '=', $idTrabalho)
            ->get();
    }

    public static function getEstudanteTrabalhoID($id_trabalho){
        return DB::table('envolvente')->where('id_trabalho',$id_trabalho)->select('id_estudante')->get();
    }

    public static function getTotalTrabalhosByFaculdade($id_faculdade){
        return DB::table('trabalho')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
            ->select('trabalho.id', 'trabalho.tema')
            ->where('faculdade.id',$id_faculdade)
            ->where('trabalho.estado',1)
            ->distinct('trabalho_departamento.id_trabalho')
            ->count();
    }

    public static function getTotalEstudantesByFaculdade($id_faculdade){
        return DB::table('trabalho')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
            ->select('trabalho.id', 'trabalho.tema')
            ->where('faculdade.id',$id_faculdade)
            ->where('trabalho.estado',1)
            ->count();
    }

    public static function getDepartamentosByFaculdade($id_faculdade){
        return DB::table('faculdade')
            ->join('departamento', 'departamento.id_faculdade', '=', 'faculdade.id')
            ->select('departamento.id','departamento.nome')
            ->where('faculdade.id',$id_faculdade)
            ->where('departamento.tipo',2)
            ->get();
    }
    
    //Conta quantos trabalhos cada departamento possui
    public static function contTrabalhosDepartamento($id_departamento){
        return DB::table('trabalho')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            //->join('trabalho', 'trabalho.id', '=', 'departamento.id_faculdade')
            ->select('trabalho.id')
            ->where('departamento.id',$id_departamento)
            ->count('trabalho.id');
    }

    //Conta trabalhos defendidos ou em curso
    public static function contTrabalhosTipo($estado,$id_faculdade){
        return DB::table('trabalho')
            ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
            ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
            ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
            //->select('trabalho.id')
            ->where('trabalho.estado',$estado)
            ->where('faculdade.id','=',$id_faculdade)
            ->distinct('trabalho_departamento.id_trabalho') 
            ->count('trabalho.id');  
    }

}
