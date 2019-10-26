<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Pessoa;
use App\Model\Funcionario_Faculdade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listarUtilizadores(){

        $dados = DB::table('pessoa')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.id','pessoa.nome', 'funcionario_faculdade.funcao', 'users.email')
            //->where('users.id','=',Auth::user()->id)
            ->get();

        return view('perfil.listarUtilizadores',compact('dados'));
    }

    //Ver perfil do utilizador pesquisado
    public function verPerfilUtilizador($id){

            $dados = DB::table('pessoa')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','pessoa.faculdade', 'funcionario_faculdade.funcao', 'users.email','users.tipo','users.estado')
            ->where('pessoa.id','=',$id)
            ->get();
            
        return view('perfil.verPerfilUtilizador',compact('dados'));
    }

    //função para redefinir a senha do utilizador
    public function redefinirSenha(Request $request){
        $validatedData = $request->validate([
            'senha' => ['required', 'string','min:6'],
            'confirmarsenha' => ['required', 'string','min:6','same:senha'],
        ],[
            //Mensagens de validação de erros
            'senha.min'=>'A senha deve possuir no mínimo 6 dígitos',
            'confirmarsenha.min'=>'A senha de confirmação deve possuir no mínimo 6 dígitos',
            'confirmarsenha.same'=>'As senhas fornecidas não coincidem, por favor forneça senhas iguais'
        ]);
        //abertura da sessão para variável dados
        $dados = session('dados');

        if($request->senha == $request->confirmarsenha){
            DB::table('users')
                ->where('estado','activo')            
                ->where('id','=',$dados[0]->id)
                ->update(['password' => Hash::make($request->senha),'qtd_vezes'=>1]);
                return back()->with('info','Senha definida com sucesso, pode efectuar o login');
        }
    }
}
