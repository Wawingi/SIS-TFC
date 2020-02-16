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
            'bi' => ['required', 'string', 'max:15', 'unique:pessoa'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefone' => ['required','min:8', 'max:11', 'unique:pessoa'],
        ],[
            //Mensagens de validação de erros
            'telefone.min'=>'A quantidade de digítos telefonicos é inferior',
            'telefone.max'=>'A quantidade de digítos telefonicos é superior',
        ]);

        //Variavel para armazenar tipo
        $tipoUtilizador;

        //Pega sessao
        $dados=session('dados_logado');

        //Se utilizador for funcionário então pegamos o ID do seu departamento, senão então o departamento será sempre do logado 
        if($request->input('tipo')=="Funcionario"){
            $departamento = new Departamento;
            $departamento = $departamento->pegaDepartamentoId($request->input('departamento'));
            $id_departamento = $departamento[0]->id;
        }else{
            $id_departamento = $dados[0]->id_departamento;
        }
        
        //Regista a pessoa e retorna o ID gerado
        $idPessoa = DB::table('pessoa')->insertGetId(
            ['nome' => $request->nome,'data_nascimento' =>$request->data_nascimento,'telefone' => $request->telefone,'bi' => $request->bi,'genero' => $request->genero]
        );
        
        if($idPessoa>0){
            //Regista o departamento do utilizador
            DB::table('pessoa_departamento')->insert(
                ['id_pessoa' => $idPessoa, 'id_departamento' => $id_departamento]
            );
            
            if(Auth::user()->tipo == "funcionario"){
                $funcionario = new Funcionario;
                $funcionario->id_pessoa = $idPessoa;
                $funcionario->funcao = $request->input('funcao');
                if($funcionario->save()){
                    $tipoUtilizador = "funcionario";
                }
            }else if(Auth::user()->tipo == "docente" && $request->input('tipo')=="Docente"){
                $docente = new Docente;
                $docente->id_pessoa = $idPessoa;
                $docente->nivel_academico = $request->input('nivel_academico');                           
                if($docente->save()){
                    $tipoUtilizador = "docente";
                }
            }else if(Auth::user()->tipo == "docente" && $request->input('tipo')=="Estudante"){
                //Pegar ID do curso em função do nome
                $curso = new Curso;
                $curso = $curso->pegaCursoId($request->input('curso'));

                $estudante = new Estudante;
                $estudante->id_pessoa = $idPessoa;  
                $estudante->numero_mecanografico = $request->input('numero_mecanografico');
                $estudante->periodo = $request->input('periodo');
                $estudante->id_curso = $curso[0]->id;
                if($estudante->save()){
                    $tipoUtilizador = "estudante";
                }
            }

            //Regista o utilizador em função do ID gerado
            /*$utilizador = new User;
            $utilizador->email = $request->input('email');
            $utilizador->password = Hash::make(654321);
            $utilizador->estado = 'activo';
            $utilizador->tipo = $tipoUtilizador;
            $utilizador->qtd_vezes = 0;
            $utilizador->id_pessoa = $idPessoa;*/

            //Regista o utilizador e retorna o ID gerado
            $idUser = DB::table('users')->insertGetId(
                ['email' => $request->email,'password' =>Hash::make(654321),'estado' => 'activo','tipo' => $tipoUtilizador,'qtd_vezes' => 0,'id_pessoa' => $idPessoa]
            );
            
            if($idUser > 0){
                if($tipoUtilizador=='estudante'){
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
}
