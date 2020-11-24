<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tema extends Model
{
    protected $table = 'trabalho';

    //retorna os temas registados
    public static function getTemas()
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('docente', 'docente.id_pessoa', '=', 'trabalho.id_docente')
            ->join('pessoa', 'pessoa.id', '=', 'docente.id_pessoa')
            ->select('trabalho.id', 'trabalho.tema', 'area_aplicacao.nome', 'pessoa.nome as orientador')
            ->orderBy('area_aplicacao.nome')
            ->get();
    }

    //retorna um tema
    public static function getTema($id)
    {
        return DB::table('trabalho')
            ->join('area_aplicacao', 'area_aplicacao.id', '=', 'trabalho.id_area')
            ->join('pessoa', 'pessoa.id', '=', 'trabalho.id_docente')
            ->select('trabalho.id', 'trabalho.tema', 'trabalho.descricao', 'trabalho.proveniencia', 'trabalho.created_at', 'area_aplicacao.nome as area', 'pessoa.nome as docente', 'estado')
            ->where('trabalho.id', '=', $id)
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
            ->select('pessoa.nome', 'pessoa.bi', 'curso.nome as nome_curso')
            ->where('trabalho.id', '=', $idTrabalho)
            ->get();
    }
}
