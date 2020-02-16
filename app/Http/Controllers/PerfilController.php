<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Pessoa;
use App\Model\Funcionario_Faculdade;
use App\Role;
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

    public function getUsers(){
        $dados = DB::table('pessoa')
            ->join('funcionario_faculdade', 'pessoa.id', '=', 'funcionario_faculdade.id')
            ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
            ->select('pessoa.id','pessoa.nome', 'funcionario_faculdade.funcao', 'users.email')
            //->where('users.id','=',Auth::user()->id)
            ->get();

            return $dados;
    }

    //Listar utilizadores em função ao tipo 
    public function listarUtilizadores(){
        $sessao = session('dados_logado');
        if(Auth::user()->tipo == 'funcionario'){
            //lista funcionários
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id','pessoa.nome', 'funcionario.funcao', 'users.email','faculdade.nome as faculdade')
                ->where('faculdade.nome','=',$sessao[0]->faculdade)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->get();
                return view('perfil.listarUtilizadores',compact('dados'));
        }else if(Auth::user()->tipo == 'docente'){
            //lista de docentes
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->select('pessoa.id','pessoa.nome', 'users.email')
                ->where('departamento.nome','=',$sessao[0]->departamento)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->get();
            //lista de estudantes
            $dadosEstudante = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->select('pessoa.id','pessoa.nome', 'users.email','users.tipo')
                ->where('departamento.nome','=',$sessao[0]->departamento)
                ->get();
                return view('perfil.listarUtilizadores',compact('dados','dadosEstudante'));
        }
    }

    //Ver perfil do utilizador autenticado
    public function verPerfil(){
        $sessao = session('dados_logado');
        //Função que pega as roles do utilizador logado
        $roles = Role::pegaRoleUtilizador($sessao[0]->id_pessoa);

        return view('perfil.verPerfil',compact('roles'));
    }

    //Ver perfil do utilizador pesquisado
    public function verPerfilUtilizador($id,$tipo=null){
        $sessao = session('dados_logado');
        if($tipo == 'estudante'){
            $dados = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->join('curso','curso.id','=','estudante.id_curso')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','estudante.numero_mecanografico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento','curso.nome as curso')
                ->where('pessoa.id','=',$id)
                ->get();
        }else if(Auth::user()->tipo == 'funcionario'){        
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','funcionario.funcao','users.id', 'users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('users.id_pessoa','=',$id)
                ->get();
        }else if(Auth::user()->tipo == 'docente'){
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.nome','pessoa.data_nascimento','pessoa.telefone','pessoa.bi','pessoa.genero','docente.nivel_academico','users.id','users.email','users.tipo','users.estado','faculdade.nome as faculdade','departamento.nome as departamento')
                ->where('pessoa.id','=',$id)
                ->get();
        }

        //Função que pega as roles de um utilizador pesquisado
        $roles = Role::pegaRoleUtilizador($id);
        
        return view('perfil.verPerfilUtilizador',compact('dados','roles'));
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
        $dados = session('dados_logado');

        if($request->senha == $request->confirmarsenha){
            DB::table('users')
                ->where('estado','activo')            
                ->where('id','=',Auth::user()->id)
                ->update(['password' => Hash::make($request->senha),'qtd_vezes'=>1]);
                return back()->with('info','Senha definida com sucesso, pode efectuar o login');
        }
    }

    //Função para activar e desactivar a conta de um utilizador
    public function desactivarConta(Request $request){
        if(is_array($request) || is_object($request)){      
            if($request->opcao=='desactivar'){
                DB::table('users')      
                    ->where('estado','activo')         
                    ->where('id','=',$request->idUtilizador)
                    ->update(['estado' => 'desactivado']);
                    return back()->with('info','Conta desactivada com sucesso.');
            } else if ($request->opcao=='activar'){
                DB::table('users')      
                    ->where('estado','desactivado')         
                    ->where('id','=',$request->idUtilizador)
                    ->update(['estado' => 'activo']);
                    return back()->with('info','Conta activada com sucesso.');
            }
        }
    }

    //Função que associa o perfil de um determinado utilizador
    public function atribuirPerfil(Request $request){
        
        $retorno = false;
        if((is_array($request) || is_object($request)) && count($request->roles_id) > 0){
            foreach($request->roles_id as $id):
                if(DB::table('role_user')->insert(
                    ['user_id' => $request->idUtilizador, 'role_id' => $id]
                )){
                    $retorno = true;
                }
            endforeach;
        }
        if($retorno){
            return back()->with('info','Perfil adicionado com sucesso.');
        }
    }

    //Função que remove a role ou perfil de um utilizador
    public function eliminarRoleUser(Request $request){
        dd($request);
        if(DB::table('role_user')->where('id', '=', $request->id)->delete()){
            return back()->with('info','Perfil removido com sucesso.');
        }
    }
}
