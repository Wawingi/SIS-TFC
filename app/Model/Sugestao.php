<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sugestao extends Model
{
    protected $table = 'sugestao';

    //retorna as sugestões registadas
    public static function getSugestoes($id, $id_departamento)
    {
        return DB::table('sugestao')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'sugestao.id_area')
            ->join('docente', 'docente.id_pessoa', '=', 'sugestao.id_docente')
            ->join('pessoa', 'pessoa.id', '=', 'docente.id_pessoa')
            ->join('sugestao_departamento', 'sugestao_departamento.id_sugestao', '=', 'sugestao.id')
            ->join('departamento', 'departamento.id', '=', 'sugestao_departamento.id_departamento')
            ->select('sugestao.id', 'sugestao.tema', 'area_aplicacao.nome', 'sugestao.estado', 'pessoa.nome as orientador')
            ->where('proveniencia', '=', $id)
            ->where('departamento.id', '=', $id_departamento)
            ->orderBy('area_aplicacao.nome')
            ->get();
    }

    //retorna as sugestões de um tutor
    public static function getSugestoesOrientador($id)
    {
        return DB::table('sugestao')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'sugestao.id_area')
            ->select('sugestao.id', 'sugestao.tema', 'area_aplicacao.nome', 'sugestao.estado')
            ->where('id_docente', '=', $id)
            ->orderBy('area_aplicacao.nome')
            ->get();
    }

    //retorna as sugestões registadas
    public static function verSugestao($id)
    {
        return DB::table('sugestao')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'sugestao.id_area')
            ->join('pessoa', 'pessoa.id', '=', 'sugestao.id_docente')
            ->select('sugestao.id', 'sugestao.tema', 'sugestao.descricao', 'sugestao.proveniencia', 'sugestao.avaliacao', 'area_aplicacao.nome as area', 'pessoa.nome as docente', 'estado')
            ->where('sugestao.id', '=', $id)
            ->get();
    }

    //retorna os estudantes envolvidos numa sugestão
    public static function verEnvolventes($idSugestao)
    {
        return DB::table('estudante_sugestao')
            ->join('estudante', 'estudante_sugestao.id_estudante', '=', 'estudante.id_pessoa')
            ->join('sugestao', 'estudante_sugestao.id_sugestao', '=', 'sugestao.id')
            ->join('pessoa', 'pessoa.id', '=', 'estudante.id_pessoa')
            ->join('curso', 'curso.id', '=', 'estudante.id_curso')
            ->select('pessoa.id as id_pessoa', 'pessoa.nome', 'pessoa.bi', 'curso.nome as nome_curso', 'estudante_sugestao.estado')
            ->where('sugestao.id', '=', $idSugestao)
        //->where('estudante_sugestao.estado', '=', 1)
            ->get();
    }

    //Actualizar estado quando rejeitado ou aprovado a sugestão
    public static function mudarEstadoSugestao($proveniencia, $id_sugestao)
    {
        if ($proveniencia > 0 && $id_sugestao > 0) {
            if (DB::table('estudante_sugestao')
                ->where('id_sugestao', '=', $id_sugestao)
                ->delete()) {
                if ($proveniencia == 1) {
                    DB::table('sugestao')
                        ->where('id', '=', $id_sugestao)
                        ->update(['estado' => 1, 'avaliacao' => 3]);
                }
            }
        }
    }

    //retorna as sugestoes na qual um estudante foi solicitado a trabalhar
    public static function pegaConviteSugestoes($idPessoa)
    {
        return DB::table('estudante_sugestao')
            ->join('sugestao', 'sugestao.id', '=', 'estudante_sugestao.id_sugestao')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'sugestao.id_area')
            ->join('pessoa', 'pessoa.id', '=', 'sugestao.id_docente')
            ->select('sugestao.id', 'sugestao.tema', 'sugestao.descricao', 'area_aplicacao.nome as area', 'pessoa.nome as docente')
            ->where('estudante_sugestao.id_estudante', '=', $idPessoa)
            ->where('estudante_sugestao.estado', '=', 0)
            ->get();
    }

}
