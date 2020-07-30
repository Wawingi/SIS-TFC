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
            //lista funcionários e chefes de departamento
            $select = DB::table('pessoa')
                ->join('funcionario', 'pessoa.id', '=', 'funcionario.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->where('faculdade.id','=',$sessao[0]->id_faculdade)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->where('funcionario.privilegio','=',1)
                ->select('pessoa.id','pessoa.nome', 'pessoa.bi','departamento.nome as departamento','users.tipo')
                ->orderBy('pessoa.nome');
            
            $dados = DB::table('pessoa')
                ->join('docente', 'pessoa.id', '=', 'docente.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->where('faculdade.id','=',$sessao[0]->id_faculdade)
                ->where('pessoa.id','<>',$sessao[0]->id_pessoa)
                ->where('docente.privilegio','=',1)
                ->select('pessoa.id','pessoa.nome', 'pessoa.bi','departamento.nome as departamento','users.tipo')
                ->orderBy('pessoa.nome')
                ->union($select)
                ->get();   
                return view('perfil.listarUtilizadores',compact('dados'));
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
                ->orderBy('pessoa.nome')
                ->get();
            //lista de estudantes
            $dadosEstudante = DB::table('pessoa')
                ->join('estudante', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
                ->join('pessoa_departamento', 'pessoa.id', '=', 'pessoa_departamento.id_pessoa')
                ->join('departamento', 'departamento.id', '=', 'pessoa_departamento.id_departamento')
                ->select('pessoa.id','pessoa.nome', 'pessoa.bi','users.tipo','users.email')
                ->where('departamento.nome','=',$sessao[0]->departamento)
                ->orderBy('pessoa.nome')
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
        //dd($dados);
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

    //função para redefinir a senha do utilizador no primeiro acesso
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

    //Resetar a senha para padrão
    public function resetarSenha($idPessoa){
        if($idPessoa > 0){
            DB::table('users')
                ->where('estado',1)            
                ->where('id_pessoa','=',$idPessoa)
                ->update(['password' => Hash::make(654321),'qtd_vezes'=>0]);
        }
    }

    //Trocar a senha do utilizador logado
    public function trocarSenha(Request $request){
        $validatedData = $request->validate([
            'senhaactual' => ['required', 'string','min:6'],
            'novasenha' => ['required', 'string','min:6'],
            'confirmarsenha' => ['required', 'string','min:6','same:novasenha'],
        ],[
            //Mensagens de validação de erros
            'senhaactual.required'=>'A senha actual deve ser fornecida.',
            'novasenha.required'=>'A nova senha deve ser fornecida',
            'confirmarsenha.required'=>'Este campo deve ser preenchido.',
            'senhaactual.min'=>'A senha deve possuir no mínimo 6 dígitos',
            'novasenha.min'=>'A senha deve possuir no mínimo 6 dígitos',
            'confirmarsenha.min'=>'A senha de confirmação deve possuir no mínimo 6 dígitos',
            'confirmarsenha.same'=>'As senhas fornecidas não coincidem, por favor forneça senhas iguais'
        ]);
        $sessao = session('dados_logado');
        $info = null;
        
        //Pega a senha de utilizador e Verifica se é igual a senha actual
        $password = User::getPassword($sessao[0]->id_pessoa);
        if (Hash::check($request->senhaactual,$password) && $request->novasenha == $request->confirmarsenha) {
            if(DB::table('users')
                ->where('estado',1)            
                ->where('id_pessoa','=',$sessao[0]->id_pessoa)
                ->update(['password' => Hash::make($request->novasenha)]))
            {
                $info = 'Sucesso';
            }else{
                $info = 'Erro';
            }
        }else{
            $info = 'Erro';
        }
        echo $info;
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

    //Registar perfil de utilizador
    public function registarPerfil(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'max:1'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'O nome é necessário',
            'descricao.required'=>'A descrição é necessário',
            'tipo.required'=>'O tipo é necessário',
        ]);
        
        $info = null;

        $role = new Role;
        $role->nome = $request->nome;
        $role->desc = $request->descricao;    
        $role->tipo = $request->tipo;
        
        if($role->save()){
            $info = 'Sucesso';
        }
        echo $info;        
    }

    //Listar perfis de utilizador
    public function pegaPerfilUtilizador($isDeleted){
        //Dados da sessão
        $sessao=session('dados_logado');
        $tipo = $sessao[0]->tipo;

        if($isDeleted==0){
            if($tipo==1){
                $roles = DB::table('roles')
                ->select('id','nome','desc','tipo','deleted_at')    
                ->where('tipo','=',$tipo)
                ->where('deleted_at','=',null)
                ->get();
            }else if($tipo==2){
                $roles = DB::table('roles')
                ->select('id','nome','desc','tipo','deleted_at') 
                ->whereNull('deleted_at')
                ->where(function ($query) {
                    $query->where('tipo','=',2)
                          ->orWhere('tipo','=', 3);
                })                                                                                                     
                ->get();
            }
        }else if($isDeleted==1){
            if($tipo==1){
                $roles = DB::table('roles')
                ->select('id','nome','desc','tipo','deleted_at')    
                ->where('tipo','=',$tipo)
                ->where('deleted_at','<>',null)
                ->get();
            }else if($tipo==2){
                $roles = DB::table('roles')
                ->select('id','nome','desc','tipo','deleted_at') 
                ->whereNotNull('deleted_at')
                ->where(function ($query) {
                    $query->where('tipo','=',2)
                          ->orWhere('tipo','=', 3);
                })              
                ->get();
            }
        }      
        return view('configuracao.perfilTable',compact('roles','isDeleted'));
    }

    //Editar perfil de utilizador
    public function editarPerfil(Request $request){
        $info = null;
        if(DB::table('roles')          
                ->where('id','=',$request->id_edit)
                ->update(['nome' => $request->nome_edit,'desc'=>$request->desc_edit])){
            $info = 'Sucesso';
        }    
        echo $info;     
    }

    //Função que remove o perfil com softdelete (não permanente)
    public function softDeletePerfil($id){
        $info = null;
        if(Role::destroy($id)){
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que restaura o perfil eliminado com softdelete
    public function restaurarPerfil($id){
        $info = null;
        if(Role::withTrashed()
                ->where('id', $id)
                ->restore())
        {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que permite ver um determinado perfil
    public function verRole($id,$nome,$descricao,$tipo){
        $id = base64_decode($id);
        $nome = base64_decode($nome);
        $descricao = base64_decode($descricao);
        $tipo = base64_decode($tipo);

        $perfil = new Role;
        $perfil->id = $id;
        $perfil->nome = $nome;
        $perfil->descricao = $descricao;
        $perfil->tipo = $tipo;

        $permissions = Role::pegaPermissionsRole($id);

        return view('configuracao.verPerfilUtilizador',compact('perfil','permissions'));
    }

    //Remover a permissão associada a um perfil
    public function removerPermissao($idPermission,$idRole){
        $info = null;
        if(DB::table('permission_role')      
            ->where('permission_id',$idPermission)         
            ->where('role_id',$idRole)
            ->delete())
        {
            $info ='Sucesso';
        }
        echo $info;
    }

    //associar permissão a um perfil
    public function associarPermission(Request $request){
        $info = null;
        if((is_array($request->permission_id) || is_object($request->permission_id)) && count($request->permission_id) > 0 && $request->idRole){
            foreach($request->permission_id as $idPermission):
                if(DB::table('permission_role')->insert(
                    ['permission_id' => $idPermission, 'role_id' => $request->idRole]
                )){
                    $retorno = true;
                }
            endforeach;
            $info = 'Sucesso';
        }else{
            $info ='Erro';
        }
        echo $info;
    }

}
