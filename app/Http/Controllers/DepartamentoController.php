<?php

namespace App\Http\Controllers;

use App\Model\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index(){

        $departamento = new Departamento;
        $departamentos = $departamento->listarDepartamentos();

        return view('departamento.listarDepartamentos',compact('departamentos'));
    }

    public function registarDepartamento(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:200', 'unique:departamento'],
            'chefe_departamento' => ['required', 'string', 'max:200'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:departamento'],
            'telefone' => ['required','min:9', 'max:9', 'unique:departamento'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'Por favor, informe o nome do departamento',
            'chefe_departamento.required'=>'Por favor, informe o nome do chefe do departamento',
            'email.required'=>'Por favor, informe o email',
            'telefone.required'=>'Por favor, informe o contacto telefónico',
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
        ]);
        
        if($request->input('tipo')=='Administrativo'){
            $tipo = 1;
        }else if($request->input('tipo')=='Estudantil'){
            $tipo = 2;
        }
        
        $departamento = new Departamento;
        $departamento->nome = $request->input('nome'); 
        $departamento->chefe_departamento = $request->input('chefe_departamento');
        $departamento->email = $request->input('email');
        $departamento->telefone = $request->input('telefone');
        $departamento->tipo = $tipo;
        $departamento->id_faculdade = $request->input('id_faculdade');
        if($departamento->save()){
            $info = 'Conta criada com sucesso.';
        }else{
            $info = 'Houve um erro ao criar a conta.';
        }
        return back()->with('info',$info);        
    }

}
