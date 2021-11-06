<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = 'area_aplicacao';

    use SoftDeletes;

    public static function pegaAreaId($nome,$id_departamento){
        return DB::table('area_aplicacao')
                    ->select('id')
                    ->where('nome',$nome)
                    ->where('id_departamento',$id_departamento)
                    ->value('id');
    }

    public static function getAreasByFaculdade($id_faculdade){
        return DB::table('area_aplicacao')
            ->join('departamento','departamento.id','=','area_aplicacao.id_departamento')
            ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
            ->select('area_aplicacao.nome as linha')
            ->where('faculdade.id','=',$id_faculdade)
            ->get();
    }

    public static function getAreasByDepartamento($id_departamento){
        return DB::table('area_aplicacao')
            ->join('departamento','departamento.id','=','area_aplicacao.id_departamento')
            ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
            ->select('area_aplicacao.nome as linha','departamento.nome as departamento','faculdade.nome as faculdade','faculdade.logotipo')
            ->where('departamento.id','=',$id_departamento)
            ->orderBy('departamento.nome')
            ->get();
    }
}
