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
        if(Auth::user()->tipo == 1){
            //lista funcionários
            $dados = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id','pessoa.nome', 'funcionario.funcao', 'pessoa.bi','faculdade.nome as faculdade')
                ->where('faculdade.nome','=',$sessao[0]->faculdade)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->get();
                //lista CHEFE DEPARTAMENTO
            $dadosChefeDepartamento = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->select('pessoa.id','pessoa.nome','pessoa.bi','users.tipo','departamento.nome as departamento')
                ->where('faculdade.nome','=',$sessao[0]->faculdade)
                ->where('docente.privilegio','=',1)
                ->get();
                return view('perfil.listarUtilizadores',compact('dados','dadosChefeDepartamento'));
        }else if(Auth::user()->tipo == 2){
            //lista de docentes
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->select('pessoa.id','pessoa.nome', 'pessoa.bi','users.email')
                ->where('departamento.nome','=',$sessao[0]->departamento)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->get();
            //lista de estudantes
            $dadosEstudante = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->select('pessoa.id','pessoa.nome', 'pessoa.bi','users.tipo','users.email')
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
        $id = base64_decode($id);
        $tipo = base64_decode($tipo);
        $dados = Pessoa::pegaDadosUtilizador($id,$tipo);
        return view('perfil.verPerfilUtilizador',compact('dados'));
    }

    public function pesquisarUtilizador(Request $request){
        $sessao = session('dados_logado');
        $dados = Pessoa::pegaIdPessoaByBI($request->bi);

        if(count($dados) > 0){
            $dados = Pessoa::pegaDadosUtilizadorPesquisado($dados[0]->pessoa_id,$dados[0]->tipo,$sessao[0]->tipo,$sessao[0]->id_faculdade);
            if($dados != null){
                if(count($dados)==0){
                    return back()->with('info','Nenhum utilizador encontrado'); 
                }
                return view('perfil.verPerfilUtilizador',compact('dados'));    
            }else{
                return back()->with('info','Nenhum utilizador encontrado');   
            }
        }else{     
            return back()->with('info','Nenhum utilizador encontrado');    
        }
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
                ->where('estado',1)            
                ->where('id','=',Auth::user()->id)
                ->update(['password' => Hash::make($request->senha),'qtd_vezes'=>1]);
                return back()->with('info','Senha definida com sucesso, pode efectuar o login');
        }
    }

    //Função para activar e desactivar a conta de um utilizador
    public function desactivarConta(Request $request){
        if(is_array($request) || is_object($request)){      
            if($request->opcao==2){
                DB::table('users')      
                    ->where('estado',1)         
                    ->where('id','=',$request->idUtilizador)
                    ->update(['estado' => 2]);
                    return back()->with('info','Conta desactivada com sucesso.');
            } else if ($request->opcao==1){
                DB::table('users')      
                    ->where('estado',2)         
                    ->where('id','=',$request->idUtilizador)
                    ->update(['estado' => 1]);
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
    public function eliminarRoleUser($id){
        if(DB::table('role_user')->where('id', '=', $id)->delete()){
            return back()->with('info','Perfil removido com sucesso.');
        }
    }

    public function pegaRoleUtilizador($id){
        $roles = Role::pegaRoleUtilizador($id);
        return view('perfil.rolesTable',compact('roles'));
    }

    
}
