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
        $this->middleware('auth');
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
            $dados = DB::table('pessoa')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','pessoa.faculdade', 'funcionario_faculdade.funcao','users.id','users.email','users.tipo','users.qtd_vezes')
            ->where('users.id','=',Auth::user()->id)
            ->get();
            session(['dados' => $dados]);
            if($dados[0]->qtd_vezes == 0){
                return view('perfil.AlterarSenha');
            } else {
                return view('gestao_organica.dashboard');
            }
        }
        if(Auth::user()->tipo=='departamento'){
            //return view('gestao_organica.dashboard');
        }
        if(Auth::user()->tipo=='orientador'){
            //return view('gestao_organica.dashboard');
        }
        if(Auth::user()->tipo=='estudante'){
            //return view('gestao_organica.dashboard');
        }
    }
}
