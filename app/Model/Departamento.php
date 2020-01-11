<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Departamento extends Model
{
    protected $table = 'departamento';
    
    
    public function pegaDepartamentoId($nome){
        return DB::table('departamento')->select('id','nome')->where('nome',$nome)->get();
    }

    public function listarDepartamentos(){
        $sessao = session('dados_logado');
        $dados = DB::table('departamento')
        ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
        ->select('departamento.nome','departamento.chefe_departamento','departamento.email','departamento.telefone')    
        ->where('departamento.id_faculdade','=',$sessao[0]->id_faculdade)
        ->paginate(3);
        return $dados;
    }
}
