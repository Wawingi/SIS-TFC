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
        if(Auth::user()->tipo=='unidade_organica'){
            //Dados do utilizador a guardar na sessão
            /*$dados = DB::table('pessoa','faculdade')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','funcionario_faculdade.funcao','users.id','users.email','users.tipo','users.qtd_vezes')
            ->where('users.id','=',Auth::user()->id)
            ->get();*/

            $dados = DB::select('SELECT p.nome,p.data_nascimento,p.telefone,p.bi,p.genero,u.id_pessoa,u.email,u.tipo,u.qtd_vezes,f.id "id_faculdade",f.nome "faculdade",ff.funcao FROM pessoa p,users u,faculdade f,pessoafaculdade pf,funcionario_faculdade ff WHERE p.id=ff.id_pessoa AND p.id=pf.id_pessoa AND f.id=pf.id_faculdade AND p.id=u.id_pessoa AND u.id = :id', ['id' => Auth::user()->id]);

            session(['dados_logado' => $dados]);

            if($dados[0]->qtd_vezes == 0){
                return view('perfil.AlterarSenha');
            } else {
                return view('layouts.dashboard');
            }
        }
    }
}
