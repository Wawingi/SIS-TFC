<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    protected $table = 'departamento';
    use SoftDeletes;
    
        
    public static function pegaDepartamentoByTipo($tipo,$id_faculdade){
        
        return DB::table('departamento')
                ->select('id','nome')
                ->where('tipo',$tipo)
                ->where('id_faculdade',$id_faculdade)
                ->orderBy('nome')
                ->get();
    }

    public static function pegaDepartamentoId($nome){
        return DB::table('departamento')->select('id','nome')->where('nome',$nome)->value('id');
    }

    public static function listarDepartamentos($isDeleted){
        $sessao = session('dados_logado');
        if($isDeleted==0){
            $dados = DB::table('departamento')
            ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
            ->select('departamento.id','departamento.nome','departamento.email','departamento.telefone')    
            ->where('departamento.id_faculdade','=',$sessao[0]->id_faculdade)
            ->whereNull('deleted_at')
            ->orderBy('nome')
            ->get();
            return $dados;
        }else if($isDeleted==1){
            $dados = DB::table('departamento')
            ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
            ->select('departamento.id','departamento.nome','departamento.email','departamento.telefone')    
            ->where('departamento.id_faculdade','=',$sessao[0]->id_faculdade)
            ->whereNotNull('deleted_at')
            ->orderBy('nome')
            ->get();
            return $dados;
        }
    }

    
    public static function pegaChefeDepartamento($id_departamento){
        $primeiro = DB::table('departamento')
            ->leftJoin('pessoa_departamento', 'pessoa_departamento.id_departamento', '=', 'departamento.id')
            ->leftJoin('pessoa', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
            ->leftJoin('docente', 'docente.id_pessoa', '=', 'pessoa.id')
            ->where('docente.privilegio',1)
            ->where('departamento.id',$id_departamento)
            ->select('pessoa.nome');
        
        $segundo = DB::table('departamento')
            ->leftJoin('pessoa_departamento', 'pessoa_departamento.id_departamento', '=', 'departamento.id')
            ->leftJoin('pessoa', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
            ->leftJoin('funcionario', 'funcionario.id_pessoa', '=', 'pessoa.id')
            ->where('funcionario.privilegio',1)
            ->where('departamento.id',$id_departamento)
            ->select('pessoa.nome')
            ->union($primeiro)
            ->value('pessoa.nome');
        
        return $segundo;
    }

}
