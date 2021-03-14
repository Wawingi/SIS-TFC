<?php

namespace App\Http\Controllers;

use App\Model\Tema;
use Illuminate\Support\Facades\DB;

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

    //Estudante dono do tema pretende ver o seu trabalho
    public function verMeuTrabalho(){
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
}
