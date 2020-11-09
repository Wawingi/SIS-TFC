<?php

namespace App\Http\Controllers;

use App\Model\Area;
use App\Model\AvaliacaoProposta;
use App\Model\Departamento;
use App\Model\Helper;
use App\Model\Pessoa;
use App\Model\Sugestao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SugestaoController extends Controller
{
    //protected $s;

    public function __construct()
    {
        //$this->$s = $s;
    }

    public function pegaSugestoesDepartamento()
    {
        $sessao = session('dados_logado');
        $sugestoes = Sugestao::getSugestoes(1, $sessao[0]->id_departamento);
        return view('sugestao.sugestaoDepartamentoTable', compact('sugestoes'));
    }

    public function pegaSugestoesEstudante()
    {
        $sessao = session('dados_logado');
        $sugestoes = Sugestao::getSugestoes(2, $sessao[0]->id_departamento);
        return view('sugestao.sugestaoEstudanteTable', compact('sugestoes'));
    }

    public function pegaSugestoesOrientador()
    {
        $sessao = session('dados_logado');
        $sugestoes = Sugestao::getSugestoesOrientador($sessao[0]->id_pessoa);
        return view('sugestao.meusTutorandosTable', compact('sugestoes'));
    }

    public function contSugestoesOrientador()
    {
        $sessao = session('dados_logado');
        $cont = count(Sugestao::getSugestoesOrientador($sessao[0]->id_pessoa));
        echo $cont;
    }

    public function registarSugestao(Request $request)
    {
        $request->validate([
            'tema' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'mimes:pdf', 'max:2000'],
        ], [
            //Mensagens de validação de erros
            'tema.required' => 'O tema é necessário',
            'descricao.required' => 'A descrição é necessária',
        ]);
        //Pega sessao
        $sessao = session('dados_logado');

        //Verificar a extensão e o tamanho do ficheiro a anexar
        if ($request->file('descricao')->isValid()) {
            //dd('STOPING...');
            //Pega área de aplicação do tema em causa
            $id_area = Area::pegaAreaId($request->area, $sessao[0]->id_departamento);
            switch ($sessao[0]->tipo) {
                //Se tipo for docente entao cadastre a sua sugestão
                case 2:
                    //Registado=1; Selecionado=2; Em desenvolvimento=3; Rejeitado=4,  //DPTO=1; Estudante=2 //0=Rejeitado; 1=Aprovado; 3=Padrão
                    $novoFicheiro = Helper::moverFicheiro($request->file('descricao'), $request->tema, $sessao[0]->id_pessoa, 'propostas'); //Função que move o ficheiro anexado
                    //Regista a sugestao e retorna o ID gerado
                    $idSugestao = DB::table('sugestao')->insertGetId(
                        ['tema' => strtoupper($request->tema), 'descricao' => $novoFicheiro, 'estado' => 1, 'visibilidade' => 1, 'id_area' => $id_area, 'proveniencia' => 1, 'id_docente' => $sessao[0]->id_pessoa, 'avaliacao' => 3, 'created_at' => date('Y-m-d H:i:s', strtotime('today')), 'updated_at' => date('Y-m-d H:i:s', strtotime('today'))]
                    );

                    if ($idSugestao > 0) {
                        if (DB::table('sugestao_departamento')->insert(
                            ['id_sugestao' => $idSugestao, 'id_departamento' => $sessao[0]->id_departamento]
                        )) {
                            echo 'Sucesso';
                        } else {
                            return;
                        }
                    }
                    break;
                //se tipo for estudante entao cadastre a sua sugestão
                case 3:
                    $id_docente = Pessoa::pegaIdPessoaByNome($request->docente);
                    $novoFicheiro = Helper::moverFicheiro($request->file('descricao'), $request->tema, $sessao[0]->id_pessoa, 'propostas'); //Função que move o ficheiro anexado
                    //Regista a sugestao e retorna o ID gerado
                    $idSugestao = DB::table('sugestao')->insertGetId(
                        ['tema' => strtoupper($request->tema), 'descricao' => $novoFicheiro, 'estado' => 1, 'visibilidade' => 1, 'id_area' => $id_area, 'proveniencia' => 2, 'id_docente' => $id_docente, 'avaliacao' => 3, 'created_at' => date('Y-m-d H:i:s', strtotime('today')), 'updated_at' => date('Y-m-d H:i:s', strtotime('today'))]
                    );

                    if ($id_docente > 0 && $idSugestao > 0) {
                        //Verifica se envolventes é um array não null, trazendo varios estudantes associados a uma sugestao
                        if ($request->envolventes == null) {
                            //Registar o departamento da sugestão
                            if (DB::table('sugestao_departamento')->insert(
                                ['id_sugestao' => $idSugestao, 'id_departamento' => $sessao[0]->id_departamento]
                            )) {
                                //Registar o estudante da sugestão
                                if (DB::table('estudante_sugestao')->insert(
                                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $idSugestao, 'estado' => 1]
                                )) {
                                    echo 'Sucesso';
                                };
                            };
                        } else {
                            //Persistir departamento do estudante logado
                            if (DB::table('sugestao_departamento')->insert(
                                ['id_sugestao' => $idSugestao, 'id_departamento' => $sessao[0]->id_departamento]
                            )) {
                                //Persistir id do estudante logado
                                DB::table('estudante_sugestao')->insert(
                                    ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $idSugestao, 'estado' => 1]
                                );

                                foreach ($request->envolventes as $envolvente) {
                                    $idDepartamento = Departamento::pegaDepartamentoPessoa($envolvente);
                                    //Ver se já tem a sugestão_d e departamento_id registado
                                    if (DB::table('sugestao_departamento')->where('id_sugestao', $idSugestao)->where('id_departamento', $idDepartamento)->count() < 1) {
                                        DB::table('sugestao_departamento')->insert(
                                            ['id_sugestao' => $idSugestao, 'id_departamento' => $idDepartamento]
                                        );
                                    }

                                    DB::table('estudante_sugestao')->insert(
                                        ['id_estudante' => $envolvente, 'id_sugestao' => $idSugestao, 'estado' => 0]
                                    );
                                }
                            }
                            echo 'Sucesso';
                        }
                    }
                    break;
            }
        } else {
            echo 'Erro';
        }

    }

    public function verSugestao($id, $notificacao = null)
    {
        $id = base64_decode($id);
        $notificacao = base64_decode($notificacao);
        $sugestao = Sugestao::verSugestao($id);
        return view('sugestao.verSugestao', compact('sugestao', 'notificacao'));
    }

    //ver os envolventes de um tema proposto por estudantes
    public function verEnvolventes($idSugestao)
    {
        $envolventes = Sugestao::verEnvolventes($idSugestao);
        return view('sugestao.envolventesTable', compact('envolventes'));
    }

    //Função que adiciona estudantes a trabalhar num tema sugerido pelo DPTO
    public function trabalharSugestao(Request $request)
    {
        //estado=0: estudante adicionado a um tema, cabendo a ele aprovar ou rejeitar
        //estado=1: estudante aceite o tema
        //Pega sessao
        $sessao = session('dados_logado');

        if ($request->sugestaoTrabalhar_id > 0) {
            //Verifica se envolventes é um array não null, trazendo varios estudantes associados a uma sugestao
            if ($request->envolventes == null) {
                //Registar o departamento da sugestão
                if (DB::table('sugestao_departamento')->insert(
                    ['id_sugestao' => $request->sugestaoTrabalhar_id, 'id_departamento' => $sessao[0]->id_departamento]
                )) {
                    if (DB::table('estudante_sugestao')->insert(
                        ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id, 'estado' => 1]
                    )) {
                        //Mudar o estado para selecionado (2) quando alguem escolher primeiro o tema
                        DB::table('sugestao')
                            ->where('id', '=', $request->sugestaoTrabalhar_id)
                            ->update(['estado' => 2]);
                        return back()->with('info', 'Foste adicionado ao tema com sucesso.');
                    };
                }
            } else {
                if (DB::table('sugestao_departamento')->insert(
                    ['id_sugestao' => $request->sugestaoTrabalhar_id, 'id_departamento' => $sessao[0]->id_departamento]
                )) {
                    DB::table('estudante_sugestao')->insert(
                        ['id_estudante' => $sessao[0]->id_pessoa, 'id_sugestao' => $request->sugestaoTrabalhar_id, 'estado' => 1]
                    );

                    foreach ($request->envolventes as $envolvente) {
                        $idDepartamento = Departamento::pegaDepartamentoPessoa($envolvente);
                        DB::table('sugestao_departamento')->insert(
                            ['id_sugestao' => $request->sugestaoTrabalhar_id, 'id_departamento' => $idDepartamento]
                        );
                        $idPessoa = Pessoa::pegaIdPessoaByNome($envolvente);
                        DB::table('estudante_sugestao')->insert(
                            ['id_estudante' => $envolvente, 'id_sugestao' => $request->sugestaoTrabalhar_id, 'estado' => 0]
                        );
                    }
                }
                //Mudar o estado para selecionado quando alguem trabalhar num tema
                DB::table('sugestao')
                    ->where('id', '=', $request->sugestaoTrabalhar_id)
                    ->update(['estado' => 2]);
                return back()->with('info', 'Foste adicionado ao tema com sucesso.');
            }
        }
    }

    //FUnção para abandonar o grupo de um determinado tema proposto
    public function sairGrupo($idSugestao, $idPessoa, $proveniencia, $descricao)
    {
        $info = null;
        $contEnvolventes = count(Sugestao::verEnvolventes($idSugestao));
        if ($contEnvolventes == 1) { //mudar o estado para 1 (registado) caso o tema esteja associado a um aluno
            if ($proveniencia == 2) {
                if (Helper::eliminarFicheiro($descricao, 'propostas')) {
                    DB::table('sugestao')
                        ->where('id', '=', $idSugestao)
                        ->where('proveniencia', '=', $proveniencia)
                        ->delete();
                } else {
                    DB::table('sugestao')
                        ->where('id', '=', $idSugestao)
                        ->where('proveniencia', '=', $proveniencia)
                        ->delete();
                }
            } else if ($proveniencia == 1) {
                DB::table('sugestao')
                    ->where('id', '=', $idSugestao)
                    ->update(['estado' => 1]);
            }
        }

        DB::table('estudante_sugestao')
            ->where('id_sugestao', '=', $idSugestao)
            ->where('id_estudante', '=', $idPessoa)
            ->delete();

        if ($proveniencia == 2 && $contEnvolventes == 1) {
            $info = 'Sucesso_Estudante';
        }
        echo $info;
    }

    //Função para aceitar a proposta na qual um estudante foi adicionada
    public function aceitarProposta($idPessoa, $idSugestao)
    {
        //estado 0: pendente sobre aceitação em trabalhar
        //estado 1: aceite trabalhar numa proposta
        if (DB::table('estudante_sugestao')
            ->where('id_estudante', '=', $idPessoa)
            ->where('id_sugestao', '=', $idSugestao)
            ->update(['estado' => 1])) {
            if (DB::table('estudante_sugestao')
                ->where('id_estudante', '=', $idPessoa)
                ->where('estado', '=', 0)
                ->delete()) {
                $info = 'Sucesso';
            }
        } else {
            $info = 'Erro';
        }
        echo $info;
    }

    //FUnção para negar o convite para trabalhar num tema
    public function negarProposta($idSugestao, $idPessoa)
    {
        $info = null;
        if (DB::table('estudante_sugestao')
            ->where('id_sugestao', '=', $idSugestao)
            ->where('id_estudante', '=', $idPessoa)
            ->delete()) {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Rejeitar proposta pelo corpo científico
    public function rejeitarProposta(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => ['required'],
        ], [
            //Mensagens de validação de erros
            'descricao.required' => 'A descrição é necessária',
        ]);
        $info = null;
        if (DB::table('sugestao')
            ->where('id', '=', $request->idSugestao)
            ->update(['estado' => 4, 'avaliacao' => 0])) {
            $avaliacao = new AvaliacaoProposta;
            $avaliacao->descricao = $request->descricao;
            $avaliacao->id_sugestao = $request->idSugestao;
            if ($avaliacao->save()) {
                Sugestao::mudarEstadoSugestao($request->proveniencia, $request->idSugestao);
                $info = 'Sucesso';
            }
        }
        echo $info;
    }

    public function verMotivoRejeicao($idSugestao)
    {
        return DB::table('avaliacao_sugestao')
            ->where('id_sugestao', '=', $idSugestao)
            ->value('descricao');
    }

    //Quando a proposta ou sugestão é aceite, então cria um trabalho
    public function criarTrabalho($idSugestao)
    {
        $sugestao = DB::table('sugestao')
            ->select('sugestao.id', 'sugestao.tema', 'sugestao.descricao', 'sugestao.proveniencia', 'sugestao.id_area', 'sugestao.id_docente')
            ->where('sugestao.id', '=', $idSugestao)
            ->first();

        $id_departamentos = DB::table('estudante_sugestao')
            ->join('estudante', 'estudante_sugestao.id_estudante', '=', 'estudante.id_pessoa')
            ->join('curso', 'estudante.id_curso', '=', 'curso.id')
            ->join('departamento', 'curso.id_departamento', '=', 'departamento.id')
            ->select('departamento.id', 'departamento.nome')
            ->where('estudante_sugestao.id_sugestao', '=', $idSugestao)
            ->where('estudante_sugestao.estado', '=', 1)
            ->get();

        if (is_object($sugestao)) {
            //estado 1: Em desenvolvimento, 2:concluído
            $idTrabalho = DB::table('trabalho')->insertGetId(
                ['tema' => $sugestao->tema, 'descricao' => $sugestao->descricao, 'proveniencia' => $sugestao->proveniencia, 'estado' => 1, 'id_area' => $sugestao->id_area, 'id_docente' => $sugestao->id_docente, 'created_at' => date('Y-m-d H:i:s', strtotime('today')), 'updated_at' => date('Y-m-d H:i:s', strtotime('today'))]
            );
            if ($idTrabalho > 0) {
                foreach ($id_departamentos as $id_departamento) {
                    DB::table('trabalho_departamento')->insert(
                        ['id_trabalho' => $idTrabalho, 'id_departamento' => $id_departamento->id]
                    );
                }
                return true;
            }
        } else {
            return;
        }
    }

    //Aprovar a proposta por parte do conselho cientifico do departamento
    public function aprovarProposta($idSugestao)
    {
        $info = null;
        if ($this->criarTrabalho($idSugestao)) {
            if (DB::table('sugestao')
                ->where('id', '=', $idSugestao)
                ->update(['estado' => 3, 'avaliacao' => 1])) {
                $info = 'Sucesso';
            } else { $info = null;}

            if (DB::table('estudante_sugestao')
                ->where('id_sugestao', '=', $idSugestao)
                ->where('estado', '=', 0)
                ->delete()) {
                $info = 'Sucesso';
            } else { $info = null;}
        }
        echo $info;
    }

    //Adicionar novo estudante a uma sugestão ou proposta
    public function adicionarEstudante(Request $request)
    {
        $info = null;
        $idPessoa = Pessoa::pegaIdPessoaByNome($request->envolventes[0]);
        if (DB::table('estudante_sugestao')->insert(
            ['id_estudante' => $idPessoa, 'id_sugestao' => $request->sugestao_id, 'estado' => 0]
        )) {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Trocar o orientador de um determinado tema
    public function trocarTutor(Request $request)
    {
        $info = null;
        if (DB::table('sugestao')
            ->where('id', '=', $request->sugestao_id)
            ->update(['id_docente' => $request->orientador])) {
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Listar os sugestoes na qual um estudante foi solicitado a trabalhar
    public function listarConvitesSugestao()
    {
        $sessao = session('dados_logado');
        $convites = Sugestao::pegaConviteSugestoes($sessao[0]->id_pessoa);
        //dd($convites);
        return view('sugestao.listaConvitesSugestao', compact('convites'));
    }
}
