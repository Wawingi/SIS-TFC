<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provapublica extends Model
{
    protected $table = 'prova_publica';

    public static function getProvaPublica($id_departamento){
        return DB::table('prova_publica')
                ->join('trabalho', 'trabalho.id', '=', 'prova_publica.id_trabalho')
                ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
                ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
                //->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                //->join('envolvente', 'envolvente.id_trabalho', '=', 'trabalho.id')
                //->join('estudante', 'estudante.id_pessoa', '=', 'envolvente.id_estudante')
                //->join('pessoa', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->select('trabalho.tema','prova_publica.nota','prova_publica.created_at')
                ->where('departamento.id',$id_departamento)
                ->where('trabalho.estado',2)
                ->distinct('trabalho.tema')
                ->get();
    }
}
