<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Area;
use App\Model\Departamento;
use App\Model\Sugestao;
use App\Model\Pessoa;
use Illuminate\Support\Facades\DB;


class SugestaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function pegaSugestoesDepartamento(){
        $sugestoes = Sugestao::getSugestoes(1);
        return view('sugestao.sugestaoDepartamentoTable',compact('sugestoes'));
    }

    public function pegaSugestoesEstudante(){
        $sugestoes = Sugestao::getSugestoes(2);
        return view('sugestao.sugestaoEstudanteTable',compact('sugestoes'));
    }


    public function registarSugestao(Request $request){
        $validatedData = $request->validate([
            'tema' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
        ],[
            //Mensagens de validação de erros
            'tema.required'=>'O tema é necessário',
            'descricao.required'=>'A descrição é necessária',
        ]);

        //Pega sessao
        $sessao=session('dados_logado');
        //Pega área de aplicação do tema em causa
        $id_area=Area::pegaAreaId($request->area,$sessao[0]->id_departamento);       
        switch($sessao[0]->tipo){
            //Se tipo for docente entao cadastre a sua sugestão
            case 2:
                    $sugestao = new Sugestao;
                    $sugestao->tema = $request->tema;
                    $sugestao->descricao = $request->descricao;       
                    $sugestao->estado = 1;         //Publicado=1; Selecionado=2; Em desenvolvimento=3; Rejeitado=4, 
                    $sugestao->visibilidade = 1;    //Visivel=1; Invisivel=2
                    $sugestao->id_area = $id_area;
                    $sugestao->id_departamento = $sessao[0]->id_departamento;
                    $sugestao->proveniencia = 1;   //DPTO=1; Estudante=2
                    $sugestao->id_docente = $sessao[0]->id_pessoa;
                    if($sugestao->save()){
                        $info = 'Sucesso';
                    };
                    echo $info;  
                    break;           
            //se tipo for estudante entao cadastre a sua sugestão
            case 3:
                    $id_docente = Pessoa::pegaIdPessoaByNome($request->docente);

                    //Regista a pessoa e retorna o ID gerado
                    $idSugestao = DB::table('sugestao')->insertGetId(
                        ['tema'=>$request->tema,'descricao'=>$request->descricao,'estado'=>1,'visibilidade'=>1,'id_area'=>$id_area,'id_departamento'=>$sessao[0]->id_departamento,'proveniencia'=>2,'id_docente'=>$id_docente]
                    );

                    if($id_docente>0 && $idSugestao>0){
                        //Verifica se envolventes é um array não null, trazendo varios estudantes associados a uma sugestao
                        if($request->envolventes == null){
                            if(DB::table('estudante_sugestao')->insert(
                                ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $idSugestao, 'estado'=>1]
                            )){
                                echo 'Sucesso';
                            };
                        } else {
                            DB::table('estudante_sugestao')->insert(
                                ['id_estudante' => $sessao[0]->id_pessoa,'id_sugestao' => $idSugestao,'estado'=>1]
                            );
                            foreach($request->envolventes as $envolvente){
                                $idPessoa=Pessoa::pegaIdPessoaByNome($envolvente);
                                DB::table('estudante_sugestao')->insert(
                                    ['id_estudante' => $idPessoa, 'id_sugestao' => $idSugestao,'estado'=>0]
                                );
                            }                           
                            echo  'Sucesso';
                        }
                    }
                    break;
        }             
    }

    public function verSugestao($id,$notificacao=null){
        $id=base64_decode($id);
        $notificacao=base64_decode($notificacao);
        $sugestao=Sugestao::verSugestao($id);
        return view('sugestao.verSugestao',compact('sugestao','notificacao'));
    }

    //ver os envolventes de um tema proposto por estudantes
    public function verEnvolventes($idSugestao){
        $envolventes = Sugestao::verEnvolventes($idSugestao);
        return view('sugestao.envolventesTable',compact('envolventes'));
    }

    //Função que adiciona estudantes a trabalhar num tema sugerido pelo DPTO
    public function trabalharSugestao(Request $request){
        //estado=0: estudante adicionado a um tema, cabendo a ele aprovar ou rejeitar
        //estado=1: estudante aceite o tema
        //Pega sessao
        $sessao=session('dados_logado');

        if($request->sugestaoTrabalhar_id>0){
            //Verifica se envolventes é um array não null, trazendo varios estudantes associados a uma sugestao
            if($request->envolventes == null){
                if(DB::table('estudante_sugestao')->insert(
                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id,'estado'=>1]
                )){
                    //Mudar o estado para selecionado quando alguem trabalhar num tema
                    DB::table('sugestao')          
                        ->where('id','=',$request->sugestaoTrabalhar_id)
                        ->update(['estado' => 2]);
                    return back()->with('info','Foste adicionado ao tema com sucesso.'); 
                };
            } else {
                DB::table('estudante_sugestao')->insert(
                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id,'estado'=>1]
                );
                foreach($request->envolventes as $envolvente){
                    $idPessoa=Pessoa::pegaIdPessoaByNome($envolvente);
                    DB::table('estudante_sugestao')->insert(
                        ['id_estudante' => $idPessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id,'estado'=>0]
                    );
                }
                //Mudar o estado para selecionado quando alguem trabalhar num tema
                DB::table('sugestao')          
                    ->where('id','=',$request->sugestaoTrabalhar_id)
                    ->update(['estado' => 2]);                       
                return back()->with('info','Foste adicionado ao tema com sucesso.');
            }
        }
    }

    //FUnção para abandonar o grupo de um determinado tema proposto
    public function sairGrupo($idSugestao,$idPessoa,$proveniencia){
        $info = null;
        $contEnvolventes = count(Sugestao::verEnvolventes($idSugestao));
        if($contEnvolventes == 1){ //mudar o estado para 1 (publicado) caso o tema esteja associado a um aluno
            if($proveniencia == 2){
                DB::table('sugestao')
                ->where('id', '=', $idSugestao)        
                ->where('proveniencia', '=', $proveniencia)        
                ->delete();
            } else if($proveniencia == 1){
                DB::table('sugestao')          
                ->where('id','=',$idSugestao)
                ->update(['estado' => 1]);  
            }         
        }

        DB::table('estudante_sugestao')
            ->where('id_sugestao', '=', $idSugestao)        
            ->where('id_estudante', '=', $idPessoa)
            ->delete();

        if($proveniencia==2 && $contEnvolventes==1){
            $info = 'Sucesso_Estudante';
        }
        echo $info;
    }

    //Função para aceitar a proposta na qual um estudante foi adicionada
    public function aceitarProposta($idPessoa,$idSugestao){
        //estado 0: pendente sobre aceitação em trabalhar
        //estado 1: aceite trabalhar numa proposta
        if(DB::table('estudante_sugestao')          
                ->where('id_estudante','=',$idPessoa)
                ->where('id_sugestao','=',$idSugestao)
                ->update(['estado' => 1])){
            $info = 'Sucesso';
        } else {
            $info = 'Erro';
        }
        echo $info;     
    }
}
