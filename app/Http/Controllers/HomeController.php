<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Pessoa;
use App\Model\Funcionario_Faculdade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        switch(Auth::user()->tipo){
            case 1:
                $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','funcionario.funcao')    
                ->where('users.id','=',Auth::user()->id)
                ->get();
                break;
            case 2:
                $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','docente.nivel_academico')    
                ->where('users.id','=',Auth::user()->id)
                ->get();
                break;                
            case 3:
                $dados = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
                ->join('curso','curso.id','=','estudante.id_curso')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','estudante.numero_mecanografico','curso.nome as curso')    
                ->where('users.id','=',Auth::user()->id)
                ->get();
                break;            
        }

        session(['dados_logado' => $dados]);
        if($dados[0]->qtd_vezes == 0){
            return view('perfil.AlterarSenha');
        } else {
            return view('layouts.dashboard');
        }
        
        /*
        if(Auth::user()->tipo=='funcionario'){
            //Dados do utilizador a guardar na sessão
            $dados = DB::table('pessoa')
            ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
            ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
            ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','funcionario.funcao')    
            ->where('users.id','=',Auth::user()->id)
            ->get();
        }
        if(Auth::user()->tipo=='docente'){
            $dados = DB::table('pessoa')
            ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
            ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
            ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','docente.nivel_academico')    
            ->where('users.id','=',Auth::user()->id)
            ->get();
        }else if(Auth::user()->tipo=='estudante'){
            $dados = DB::table('pessoa')
            ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
            ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
            ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
            ->join('curso','curso.id','=','estudante.id_curso')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','users.id_pessoa','users.email','users.tipo','users.qtd_vezes','departamento.id as id_departamento','departamento.nome as departamento','faculdade.id as id_faculdade','faculdade.nome as faculdade','estudante.numero_mecanografico','curso.nome as curso')    
            ->where('users.id','=',Auth::user()->id)
            ->get();
        }*/
            
    }
}
