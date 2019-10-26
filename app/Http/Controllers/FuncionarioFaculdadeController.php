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

class FuncionarioFaculdadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //função que retorna a faculdade do utilizador logado para o INSERT da pessoa, isto é a faculdade do ADMIN é o mesmo do registando
    public function pegaFaculdade(){
        $dados = DB::table('pessoa')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.faculdade')
            ->where('users.id','=',Auth::user()->id)
            ->get();
        return $dados;
    }

    public function registarPessoa(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'bi' => ['required', 'string', 'max:15', 'unique:pessoa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefone' => ['required','min:8', 'max:11', 'unique:pessoa'],
        ],[
            //Mensagens de validação de erros
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
        ]);
        
        //Regista a pessoa e retorna o ID gerado
        //$dados = $this->pegaFaculdade();
        $dados=session('dados');

        $idPessoa = DB::table('pessoa')->insertGetId(
            ['nome' => $request->nome,'data_nascimento' => $request->data_nascimento,'telefone' => $request->telefone,'bi' => $request->bi,'genero' => $request->genero,'faculdade' => $dados[0]->faculdade]
        );
        
        if($idPessoa>0){
            //Regista o funcionario em função do ID gerado
            $funcionario_faculdade = new Funcionario_Faculdade;
            $funcionario_faculdade->id = $idPessoa;
            $funcionario_faculdade->funcao = $request->input('funcao');
            $funcionario_faculdade->save();

            //Regista o utilizador em função do ID gerado
            $utilizador = new User;
            $utilizador->email = $request->input('email');
            $utilizador->password = Hash::make(654321);
            $utilizador->estado = 'activo';
            $utilizador->tipo = Auth::user()->tipo;
            $utilizador->id_pessoa = $idPessoa;
            
            if($utilizador->save()){         
                return back()->with('info','Conta criada com sucesso');
            };
        }
    }
}
