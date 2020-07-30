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
                ->first();
        }else if(Auth::user()->tipo == 1 && $tipo==1){        
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','funcionario.funcao','users.id', 'users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('users.id_pessoa','=',$id)
                ->first();
        }else if(Auth::user()->tipo == 2 || (Auth::user()->tipo == 1 && $tipo==2)){
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','docente.nivel_academico','docente.privilegio','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('pessoa.id','=',$id)
                ->first();
        }
        return $dados;
    }

    //Função que pega dados da pessoa pesquisada
    public static function pegaDadosUtilizadorPesquisado($id,$tipo=null,$tipoLogado,$idFaculdade){
        $dados=null;
        if($tipoLogado == 1 && $tipo == 1){
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','funcionario.funcao','users.id', 'users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('users.id_pessoa','=',$id)
                ->where('faculdade.id','=',$idFaculdade)
                ->get();
        }
        elseif(($tipoLogado == 1 || $tipoLogado == 2) && $tipo == 2){
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','docente.nivel_academico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('pessoa.id','=',$id)
                ->where('faculdade.id','=',$idFaculdade)
                ->get();
        }
        elseif($tipoLogado == 2 && $tipo == 3){
            $dados = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->join('curso','curso.id','=','estudante.id_curso')
                ->select('pessoa.id as pessoa_id','pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','estudante.numero_mecanografico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento','curso.nome as curso')
                ->where('pessoa.id','=',$id)
                ->where('faculdade.id','=',$idFaculdade)
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

    //Função que retorna os docentes de um departamento
    public static function getDocentes($id_departamento){
        return DB::table('pessoa')
                    ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                    ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                    ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                    ->select('pessoa.id as pessoa_id','pessoa.nome')
                    ->where([['departamento.id', $id_departamento],['users.tipo',2]])
                    ->get();
    }

    //Função que pega o ID da pessoa
    public static function pegaIdPessoaByNome($nome){
        return DB::table('pessoa')
                    ->select('id')
                    ->where('nome',$nome)                
                    ->value('id');
    }

    //Função que retorna os estudantes de um curso
    public static function pegaEstudantesFaculdade($faculdade,$idLogado){
        return DB::table('pessoa')
                    ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                    ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                    ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                    ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                    ->where('faculdade.nome', $faculdade)
                    ->where('pessoa.id','<>', $idLogado)
                    ->whereNotIn('pessoa.id', static function ($query) {
                        $query->select('id_estudante')
                        ->from((new EstudanteSugestao)->getTable());
                    })
                    ->select('pessoa.nome')
                    ->get();
    }

    //Função que verifica se um estudante já possui um tema
    public static function verificarEnvolvimentoSugestao($idLogado,$estado){
        return DB::table('estudante_sugestao')
                    ->where('id_estudante','=',$idLogado)
                    ->where('estado','=',$estado)
                    ->select('id_estudante','id_sugestao')
                    ->get();
    }
      
}
