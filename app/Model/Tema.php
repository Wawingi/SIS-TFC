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
}
