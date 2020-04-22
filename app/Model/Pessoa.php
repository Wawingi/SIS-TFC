<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pessoa extends Model
{
    protected $table = 'pessoa';
    
    public static function pegaDadosUtilizador($id,$tipo=null){
        if($tipo == 3){
            $dados = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->join('curso','curso.id','=','estudante.id_curso')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','estudante.numero_mecanografico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento','curso.nome as curso')
                ->where('pessoa.id','=',$id)
                ->get();
        }else if(Auth::user()->tipo == 1){        
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','funcionario.funcao','users.id', 'users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('users.id_pessoa','=',$id)
                ->get();
        }else if(Auth::user()->tipo == 2){
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','docente.nivel_academico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('pessoa.id','=',$id)
                ->get();
        }
        return $dados;
    }

    //Função que retorna o Numero da pessoa em função do seu BI
    public static function pegaIdPessoaByBI($bi){
        return DB::table('pessoa')
                    ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                    ->select('pessoa.id as pessoa_id','users.tipo')
                    ->where('bi', $bi)
                    ->get();
    }
      
}
