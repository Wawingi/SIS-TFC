<?php

namespace App\Http\Controllers;

use App\Model\Tema;
use App\Model\Area;
use App\Model\Pessoa;
use App\Model\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Gate;

class TemaController extends Controller
{
    protected $sessao;

    public function __construct()
    {   
        //$ss = session('dados_logado');
        //$this->sessao = $ss[0]->id_pessoa;
    }

    //Listar os temas a serem desenvolvidos pelos estudantes de um departamento
    public function pegaTrabalhos()
    {
        //Pega sessao
        $sessao = session('dados_logado');
        $temas = Tema::getTemas($sessao[0]->id_departamento);
        return view('tema.TrabalhoEmCursoTable', compact('temas'));
    }
    
    //Listar os temas defendidos pelos estudantes de um departamento
    public function pegaTrabalhosDefendidos()
    {
        //Pega sessao
        $sessao = session('dados_logado');
        $trabalhos = Tema::getTemasDefendidos($sessao[0]->id_departamento);
        return view('tema.trabalhoDefendidoTable', compact('trabalhos'));
    }
  
    //Pega trabalhos de um orientador
    public function pegaTrabalhosOrientador()
    {
        //Pega sessao
        $sessao = session('dados_logado');
        $trabalhos = Tema::getTemasOrientador($sessao[0]->id_pessoa);
        return view('tema.meusTutorandosTable', compact('trabalhos'));
    }

    //Ver um determinado tema (trabalho) a ser desenvolvido
    public function verTrabalho($id)
    {
        $id = base64_decode($id);
        $trabalho = Tema::getTema($id);
        return view('tema.verTrabalho', compact('trabalho'));
    }

    //Ver um determinado trabalho defendido
    public function verTrabalhoDefendido($id)
    {
        $id = base64_decode($id);
        $trabalho = Tema::getTrabalhoDefendido($id);
        return view('tema.verTrabalhoDefendido', compact('trabalho'));
    }

    //Estudante dono do tema pretende ver o seu trabalho
    public function verMeuTrabalho(){
        if(Gate::denies('visualizar_meu_trabalho'))
            return redirect()->back(); 
        //Pega sessao
        $sessao = session('dados_logado');
        $idTrabalho = DB::table('envolvente')->where('id_estudante',$sessao[0]->id_pessoa)->value('id_trabalho');
        if($idTrabalho!=null && $idTrabalho>0){
            $trabalho = Tema::getTema($idTrabalho);
            return view('tema.verTrabalho', compact('trabalho'));
        }else{
            $menu ='Temas';
            $pagina = 'Ver Trabalho';
            $info = 'AINDA NÃO POSSÚI TRABALHO.';
            return view('includes.errorPage', compact('menu','pagina','info'));
        }
    }

    //ver os envolventes de um trabalho em desenvolvimento
    public function verEnvolventesTrabalho($idTrabalho)
    {
        $envolventes = Tema::getEnvolventes($idTrabalho);
        return view('tema.envolventesTable', compact('envolventes', 'estadoSugestao'));
    }

    //Função para anexar o relatório final
    public function registarRelatorioFinal(Request $request){
        $request->validate([
            'relatorio' => ['required', 'mimes:pdf', 'max:4000'],
            'id_trabalho' => ['required'],
            'tema_trabalho' => ['required'],
        ], [
            //Mensagens de validação de erros
            'relatorio.required' => 'O ficheiro deve ser anexado.',
            'relatorio.max' => 'O ficheiro possúi um tamanho maior do estabelecido.',
            'relatorio.mimes' => 'Anexe um ficheiro PDF válido.',
        ]);        
    
        //Verificar a extensão e o tamanho do ficheiro a anexar
        if ($request->file('relatorio')->isValid()) {
            $novoFicheiro = Helper::moverRelatorioFicheiro($request->file('relatorio'),$request->tema_trabalho,$request->id_trabalho); 
            $trabalho = Tema::find($request->id_trabalho);
            $trabalho->descricao = $novoFicheiro;
            $trabalho->recomendacao = $request->recomendacao;
            if($trabalho->save()){
                return back()->with('info','Relatório anexado com sucesso.');
            }else{
                return back()->with('error','Houve um erro ao anexar o relatório.');
            }
        }else{
            return back()->with('error','Houve um erro ao anexar o relatório.');
        }
    }

    //Função para editar o relatório final
    public function editarRelatorioFinal(Request $request){
        $request->validate([
            'relatorio_edit' => ['required', 'mimes:pdf', 'max:4000'],
            'id_trabalho' => ['required'],
            'tema_trabalho' => ['required'],
        ], [
            //Mensagens de validação de erros
            'relatorio_edit.required' => 'O ficheiro deve ser anexado.',
            'relatorio_edit.max' => 'O ficheiro possúi um tamanho maior do estabelecido.',
            'relatorio_edit.mimes' => 'Anexe um ficheiro PDF válido.',
        ]);        
    
        //Verificar a extensão e o tamanho do ficheiro a anexar
        if ($request->file('relatorio_edit')->isValid()) {
            $novoFicheiro = Helper::moverRelatorioFicheiro($request->file('relatorio_edit'),$request->tema_trabalho,$request->id_trabalho); 
            $trabalho = Tema::find($request->id_trabalho);
            $trabalho->descricao = $novoFicheiro;
            $trabalho->recomendacao = $request->recomendacao_edit;
            if($trabalho->save()){
                return back()->with('info','Relatório anexado com sucesso.');
            }else{
                return back()->with('error','Houve um erro ao anexar o relatório.');
            }
        }else{
            return back()->with('error','Houve um erro ao anexar o relatório.');
        }
    }

    public function contEstatisticas(){
        $sessao=session('dados_logado');
        $id_faculdade=$sessao[0]->id_faculdade;
        
        //Contar trabalhos em progresso de uma faculdade
        $contTrabalhos=Tema::getTotalTrabalhosByFaculdade($id_faculdade);

        //Contar as linhas de investigação
        $contLinhas=count(Area::getAreasByFaculdade($id_faculdade));

        //Contar orientadores envolvidos
        $contDocentes=count(Pessoa::getTotalDocentes($id_faculdade));
        
        //Contar estudantes envolvidos
        $contEstudantes=Tema::getTotalEstudantesByFaculdade($id_faculdade);

        $contadores=["total_trabalhos"=>$contTrabalhos,"total_linhas"=>$contLinhas,"total_docentes"=>$contDocentes,"total_estudantes"=>$contEstudantes];
        
        return view('layouts.contabilidadeTrabalho',compact('contadores'));
    }

    public function contTrabalhosDepartamentos(){
        $sessao=session('dados_logado');
        $id_faculdade=$sessao[0]->id_faculdade;
        $departamentos=Tema::getDepartamentosByFaculdade($id_faculdade);

        $nomeDepartamentos=array();
        $contTrabalhos=array();
        $estatisticaTrabalhos=array();
        
        foreach($departamentos as $departamento){
            array_push($nomeDepartamentos,$departamento->nome);    
            array_push($contTrabalhos,Tema::contTrabalhosDepartamento($departamento->id));    
        }

        array_push($estatisticaTrabalhos,$nomeDepartamentos,$contTrabalhos);

        return $estatisticaTrabalhos; 
    }

    public function contComparaTrabalhos(){
        $sessao=session('dados_logado');
        $id_faculdade=$sessao[0]->id_faculdade;
        $contadores = array();

        $trabalhos_curso=Tema::contTrabalhosTipo(1,$id_faculdade);
        $trabalhos_defendidos=Tema::contTrabalhosTipo(2,$id_faculdade);

                  //[{valor:x,name:y},{valor:x,name:y}]
        $contadores=[$trabalhos_curso,'Em curso',$trabalhos_defendidos,'Defendidos'];

        return $contadores;

    }
}
