<?php

namespace App\Http\Controllers;

use App\Model\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index(){

        //$departamento = new Departamento;
        //$departamentos = $departamento->listarDepartamentos();

        return view('departamento.listarDepartamentos');
    }

    public function pegaDepartamentos(){
        $departamentos = Departamento::listarDepartamentos();

        return view('departamento.departamentoTable',compact('departamentos'));
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
            $info = 'Sucesso';
        }else{
            $info = 'Erro';
        }
        echo $info;        
    }

    //Função que remove o departamento
    public function eliminarDepartamento($id){
        if(DB::table('departamento')->where('id', '=', $id)->delete()){
            return back()->with('info','Departamento eliminado com sucesso.');
        }
    }

    //Função que pega um determinado departamento
    public function pegaDepartamento($id){
        $data = Departamento::find($id);
        echo json_encode($data);
    }

    public function editarDepartamento(Request $request){
        /*$validatedData = $request->validate([
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
        ]);*/
        
        if($request->input('tipo')=='Administrativo'){
            $tipo = 1;
        }else if($request->input('tipo')=='Estudantil'){
            $tipo = 2;
        }

        if(DB::table('departamento')          
                ->where('id','=',$request->id_departamento)
                ->update(['nome' => $request->input('nome_edit'),'chefe_departamento'=>$request->input('chefe_departamento'),'email'=>$request->input('email'),'telefone'=>$request->input('telefone'),'tipo'=>$tipo])){
            $info = 'Sucesso';
        } else {
            $info = 'Erro';
        }
               

        echo $info;        
    }

    //Visualizar o departamento
    public function verDepartamento($id){
        $departamento = Departamento::find(base64_decode($id));
        return view('departamento.verDepartamento',compact('departamento'));
    }

    public function pesquisarDepartamento(Request $request){
        $sessao = session('dados_logado');

        $dados = DB::table('departamento')->where([['nome','Like','%'.$request->nome.'%'],['id_faculdade','=',$sessao[0]->id_faculdade],])->get();
                
        if(count($dados) < 1){
            return back()->with('info','Nenhum departamento encontrado');    
        }
        if(count($dados) > 1){
            return view('departamento.listaDepartamentosPesquisados',compact('dados'));    
        }
        $id_departamento = $dados[0]->id;
        return redirect()->intended('verDepartamento/'.base64_encode($id_departamento));
    }
}
