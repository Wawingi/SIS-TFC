<?php

namespace App\Http\Controllers;

use App\Model\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DepartamentoController extends Controller
{
    public function index(){
        return view('departamento.listarDepartamentos');
    }

    public function pegaDepartamentos($isDeleted){
        $departamentos = Departamento::listarDepartamentos($isDeleted);

        return view('departamento.departamentoTable',compact('departamentos','isDeleted'));
    }

    public function registarDepartamento(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:200', 'unique:departamento'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:departamento'],
            'telefone' => ['required','min:9', 'max:9', 'unique:departamento'],
            'tipo' => ['required'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'Por favor, informe o nome do departamento',
            'email.required'=>'Por favor, informe o email',
			'email.unique'=>'O email já foi informado',
            'telefone.required'=>'Por favor, informe o contacto telefónico',
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
			'telefone.unique'=>'O número já foi informado',
        ]);
        
        $departamento = new Departamento;
        $departamento->nome = $request->input('nome'); 
        $departamento->email = $request->input('email');
        $departamento->telefone = $request->input('telefone');
        $departamento->tipo = $request->input('tipo');
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
        $info = null;
        if(Departamento::destroy($id)){
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que restaura o departamento eliminado com softdelete
    public function restaurarDepartamento($id){
        $info = null;
        if(Departamento::withTrashed()
                ->where('id', $id)
                ->restore())
        {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que pega um determinado departamento
    public function pegaDepartamento($id){
        $data = Departamento::find($id);
        echo json_encode($data);
    }

    public function editarDepartamento(Request $request){
        $validatedData = $request->validate([
            //'nome' => ['required', 'string', 'max:200', 'unique:departamento'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:departamento'],
            //'telefone' => ['required','min:9', 'max:9', 'unique:departamento'],
            'tipo' => ['required'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'Por favor, informe o nome do departamento',
            'email.required'=>'Por favor, informe o email',
            'telefone.required'=>'Por favor, informe o contacto telefónico',
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
            'tipo.required'=>'O tipo do departamento deve ser informado',
        ]);

        $info = 'Erro';

        try{
            if(DB::table('departamento')          
                    ->where('id','=',$request->id_departamento)
                    ->update(['nome' => $request->input('nome_edit'),'email'=>$request->input('email'),'telefone'=>$request->input('telefone'),'tipo'=>$request->input('tipo')])){
                $info = 'Sucesso';
            } else {
                $info = 'Erro';
            }  
            echo $info;       
        }catch(Exception $e){
            echo $info;
        }        
    }

    //Visualizar o departamento
    public function verDepartamento($id){
        $departamento = Departamento::find(base64_decode($id));
        $chefe_departamento = Departamento::pegaChefeDepartamento(base64_decode($id));
        return view('departamento.verDepartamento',compact('departamento','chefe_departamento'));
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
