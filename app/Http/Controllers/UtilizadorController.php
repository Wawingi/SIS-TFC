<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Pessoa;
use App\Model\Docente;
use App\Model\Estudante;
use App\Model\Funcionario;
use App\Model\Departamento;
use App\Model\Curso;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Gate;

class UtilizadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function registarUtilizador(){
        if(Gate::denies('criar_user'))
            return redirect()->back();        
        return view('perfil.RegistarUtilizador');
    }


    public function registarPessoa(Request $request){        
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            //'bi' => ['required', 'string', 'max:15', 'unique:pessoa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefone' => ['required','min:8', 'max:11', 'unique:pessoa'],
        ],[
            //Mensagens de validação de erros
            'email.unique'=>'O email já foi associado a outra conta',
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
        ]);

        //Variaveis globais
        $tipoUtilizador;
        $id_departamento;
        
        if($request->tipo_documento==1){
            $bi=$request->bi;
        }else{
            $bi=$request->outro_doc;
        }
        //dd($request);
        //Pega sessao
        $dados=session('dados_logado');

        //Ver o tipo de utilizador e atribuir o id do departamento ideal
        if($request->tipo_registar==1){
            $id_departamento = $request->departamento_direcao;
        }else if($request->tipo_registar==2){
            $id_departamento = $request->departamento_estudantil;
        }else if($request->tipo_registar==3){
            $id_departamento = $request->departamento_estudantil;
        }

        //Regista a pessoa e retorna o ID gerado
        $idPessoa = DB::table('pessoa')->insertGetId(
            ['nome' => $request->nome,'data_nascimento' =>$request->data_nascimento,'telefone' => $request->telefone,'bi' => $bi,'genero' => $request->genero]
        );
        
        if($idPessoa>0){
            //Regista o departamento do utilizador
            if(DB::table('pessoa_departamento')->insert(
                ['id_pessoa' => $idPessoa, 'id_departamento' => $id_departamento, 'tipo' => $request->tipo_registar]
            )){
                switch($request->tipo_registar){
                    case 1:
                        $funcionario = new Funcionario;
                        $funcionario->id_pessoa = $idPessoa;
                        if($request->funcao_escolher==1){
                            $funcionario->privilegio = 1;
                            $funcionario->funcao = "Chefe do Departamento";
                        }else if($request->funcao_escolher==2){
                            $funcionario->privilegio = 0;
                            $funcionario->funcao = $request->funcao;
                        }            
                        if($funcionario->save()){
                            $tipoUtilizador = 1;
                        }
                        break;    
                    case 2:
                        $docente = new Docente;
                        $docente->id_pessoa = $idPessoa;
                        if($request->funcao_escolher==1){
                            $docente->privilegio = 1;
                        }else{
                            $docente->privilegio = 0;
                        }
                        $docente->nivel_academico = $request->nivel_academico;                           
                        if($docente->save()){
                            $tipoUtilizador = 2;
                        }
                        break;
                    case 3:
                        $estudante = new Estudante;
                        $estudante->id_pessoa = $idPessoa;  
                        $estudante->numero_mecanografico = $request->numero_mecanografico;
                        $estudante->periodo = $request->periodo;
                        $estudante->id_curso = $request->curso;
                        if($estudante->save()){
                            $tipoUtilizador = 3;
                        }
                    break;
                }    
            }
                  
            //Regista o utilizador e retorna o ID gerado
            $idUser = DB::table('users')->insertGetId(
                ['email' => $request->email,'password' =>Hash::make(654321),'estado' => 1,'tipo' => $tipoUtilizador,'qtd_vezes' => 0,'id_pessoa' => $idPessoa]
            );
            
            if($idUser > 0){
                if($tipoUtilizador==3){
                    $role = Role::pegaRole();
                    //Regista o perfil do utilizador estudante
                    DB::table('role_user')->insert(
                        ['user_id' => $idUser, 'role_id' => $role[0]->id]
                    );
                }         
                return back()->with('info','Conta criada com sucesso.');
            };
        }
    }

    public function editarPessoa(Request $request){
        $status=null;
        if(DB::table('pessoa')          
            ->where('id','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarUtilizador(Request $request){
        $status=null;
        if(DB::table('users')          
            ->where('id_pessoa','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarFuncionario(Request $request){
        $status=null;
        if(DB::table('funcionario')          
            ->where('id_pessoa','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarEstudante(Request $request){
        $status=null;
        if(DB::table('estudante')          
            ->where('id_pessoa','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarCursoEstudante(Request $request){
        $status=null;
        if(DB::table('estudante')          
            ->where('id_pessoa','=',$request->id_pessoa)
            ->update(['id_curso' => $request->curso]))
        {
            $status='Sucesso';
        }      
        echo $status;               
    }

    public function editarNivelAcademico(Request $request){
        $status=null;
        if(DB::table('docente')          
            ->where('id_pessoa','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarDepartamentoFuncionario(Request $request){
        $status=null;
        if(DB::table('pessoa_departamento')          
                ->where('id_pessoa','=',$request->id_pessoa)
                //->where('id_departamento','=',$request->departamento)
                ->update(['id_departamento' => $request->departamento]))
        {
            $status='Sucesso';
        }   
        echo $status;               
    }

    //função que pesquisa os dados do utilizador para ser editado
    public function pegaUtilizador($id,$tipo=null){
        $id = base64_decode($id);
        $tipo = base64_decode($tipo);
        $dados = Pessoa::pegaDadosUtilizador($id,$tipo);   
        return view('perfil.editarUtilizador',compact('dados'));
    }
}
