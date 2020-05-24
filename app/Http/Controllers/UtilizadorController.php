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
        if($request->input('tipo')==1 || ($request->input('tipo')==2 && Auth::user()->tipo == 1)){
            $id_departamento = Departamento::pegaDepartamentoId($request->input('departamento'));
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
                ['id_pessoa' => $idPessoa, 'id_departamento' => $id_departamento, 'tipo' => $request->tipo]
            );
            
            if(Auth::user()->tipo == 1){
                switch($request->input('tipo')){
                    case 1:
                            $funcionario = new Funcionario;
                            $funcionario->id_pessoa = $idPessoa;
                            $funcionario->funcao = $request->input('funcao');
                            if($funcionario->save()){
                                $tipoUtilizador = 1;
                            }
                            break;    
                    case 2:
                            $docente = new Docente;
                            $docente->id_pessoa = $idPessoa;
                            $docente->nivel_academico = $request->input('nivel_academico');                           
                            if($docente->save()){
                                $tipoUtilizador = 2;
                            }
                            break;
                }
            }else if(Auth::user()->tipo == 2 && $request->input('tipo')==2){
                $docente = new Docente;
                $docente->id_pessoa = $idPessoa;
                $docente->nivel_academico = $request->input('nivel_academico');                           
                if($docente->save()){
                    $tipoUtilizador = 2;
                }
            }else if(Auth::user()->tipo == 2 && $request->input('tipo')==3){
                //Pegar ID do curso em função do nome
                $curso = new Curso;
                $curso = $curso->pegaCursoId($request->input('curso'));

                $estudante = new Estudante;
                $estudante->id_pessoa = $idPessoa;  
                $estudante->numero_mecanografico = $request->input('numero_mecanografico');
                $estudante->periodo = $request->input('periodo');
                $estudante->id_curso = $curso[0]->id;
                if($estudante->save()){
                    $tipoUtilizador = 3;
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
        //Pega sessao
        $dados=session('dados_logado');
        
        //Se utilizador for funcionário então pegamos o ID do seu departamento, senão então o departamento será sempre do logado 
        if($request->input('tipo')==1){
            $departamento = new Departamento;
            $departamento = $departamento->pegaDepartamentoId($request->input('departamento'));
            $id_departamento = $departamento[0]->id;
        }else{
            $id_departamento = $dados[0]->id_departamento;
        }

        //Actualiza os dados da pessoa em função do ID
            DB::table('pessoa')          
                ->where('id','=',$request->pessoa_id)
                ->update(['nome' => $request->nome,'data_nascimento' =>$request->data_nascimento,'telefone' => $request->telefone,'bi' => $request->bi,'genero' => $request->genero]);      
                
            //Actualizar o departamento
            /*DB::table('pessoa_departamento')          
                ->where([['id_pessoa','=',$request->pessoa_id],['tipo','=',$request->input('tipo')]])
                ->update(['id_departamento' => $id_departamento]);*/
                
            //Actualizar o utilizador
            DB::table('users')
                    ->where('id_pessoa','=',$request->pessoa_id)
                    ->update(['email' => $request->email]);
           
            //Registar cada tipo de pessoa
            if(Auth::user()->tipo == 1){
                DB::table('funcionario')
                ->where('id_pessoa','=',$request->pessoa_id)
                ->update(['funcao' => $request->funcao]);

            }else if(Auth::user()->tipo == 2 && $request->input('tipo')==2){
                DB::table('docente')
                ->where('id_pessoa','=',$request->pessoa_id)
                ->update(['nivel_academico' => $request->nivel_academico]);

            }else if(Auth::user()->tipo == 2 && $request->input('tipo')==3){
                $curso = new Curso;
                $curso = $curso->pegaCursoId($request->input('curso'));

                DB::table('estudante')
                ->where('id_pessoa','=',$request->pessoa_id)
                ->update(['numero_mecanografico' => $request->numero_mecanografico,'periodo' => $request->periodo,'id_curso' => $curso[0]->id]);
            }
            return redirect()->action(
                'PerfilController@verPerfilUtilizador', ['id' => base64_encode($request->pessoa_id),'tipo' => base64_encode($request->input('tipo'))]
            )->with('info','Actualizado com sucesso.');                                  
    }

    //função que pesquisa os dados do utilizador para ser editado
    public function pegaUtilizador($id,$tipo=null){
        $id = base64_decode($id);
        $tipo = base64_decode($tipo);
        $dados = Pessoa::pegaDadosUtilizador($id,$tipo);   
        return view('perfil.editarUtilizador',compact('dados'));
    }
}
