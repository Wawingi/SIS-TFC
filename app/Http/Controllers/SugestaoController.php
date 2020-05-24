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
                                ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $idSugestao]
                            )){
                                echo 'Sucesso';
                            };
                        } else {
                            DB::table('estudante_sugestao')->insert(
                                ['id_estudante' => $sessao[0]->id_pessoa,'id_sugestao' => $idSugestao]
                            );
                            foreach($request->envolventes as $envolvente){
                                $idPessoa=Pessoa::pegaIdPessoaByNome($envolvente);
                                DB::table('estudante_sugestao')->insert(
                                    ['id_estudante' => $idPessoa, 'id_sugestao' => $idSugestao]
                                );
                            }                           
                            echo  'Sucesso';
                        }
                    }
                    break;
        }             
    }

    public function verSugestao($id){
        $id=base64_decode($id);
        $sugestao=Sugestao::verSugestao($id);
        return view('sugestao.verSugestao',compact('sugestao'));
    }

    //ver os envolventes de um tema proposto por estudantes
    public function verEnvolventes($idSugestao){
        $envolventes = Sugestao::verEnvolventes($idSugestao);
        return view('sugestao.envolventesTable',compact('envolventes'));
    }

    //Função que adiciona estudantes a trabalhar num tema sugerido pelo DPTO
    public function trabalharSugestao(Request $request){
        //Pega sessao
        $sessao=session('dados_logado');

        if($request->sugestaoTrabalhar_id>0){
            //Verifica se envolventes é um array não null, trazendo varios estudantes associados a uma sugestao
            if($request->envolventes == null){
                if(DB::table('estudante_sugestao')->insert(
                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id]
                )){
                    //Mudar o estado para selecionado quando alguem trablhar num tema
                    DB::table('sugestao')          
                        ->where('id','=',$request->sugestaoTrabalhar_id)
                        ->update(['estado' => 2]);
                    echo 'Sucesso';
                };
            } else {
                DB::table('estudante_sugestao')->insert(
                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id]
                );
                foreach($request->envolventes as $envolvente){
                    $idPessoa=Pessoa::pegaIdPessoaByNome($envolvente);
                    DB::table('estudante_sugestao')->insert(
                        ['id_estudante' => $idPessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id]
                    );
                }
                //Mudar o estado para selecionado quando alguem trablhar num tema
                DB::table('sugestao')          
                    ->where('id','=',$request->sugestaoTrabalhar_id)
                    ->update(['estado' => 2]);                       
                echo  'Sucesso';
            }
        }
    }

    //FUnção para abandonar o grupo de um determinado tema proposto
    public function sairGrupo($idSugestao,$idPessoa){
        if(DB::table('estudante_sugestao')
            ->where('id_sugestao', '=', $idSugestao)        
            ->where('id_estudante', '=', $idPessoa)
            ->delete()){
            return back()->with('info','Departamento eliminado com sucesso.');
        }
    }
}
