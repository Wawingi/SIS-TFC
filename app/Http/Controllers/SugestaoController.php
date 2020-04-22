<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Area;
use App\Model\Departamento;
use App\Model\Sugestao;
use Illuminate\Support\Facades\DB;


class SugestaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function pegaSugestoesDepartamento(){
        $sugestoes = Sugestao::getSugestoes();

        return view('sugestao.sugestaoDepartamentoTable',compact('sugestoes'));
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

        $id_area=Area::pegaAreaId($request->area,$sessao[0]->id_departamento);
        $sugestao = new Sugestao;
        $sugestao->tema = $request->tema;
        $sugestao->descricao = $request->descricao;
        $sugestao->estado = 1;
        $sugestao->visibilidade = 1;
        $sugestao->id_area = $id_area;
        $sugestao->id_departamento = $sessao[0]->id_departamento;
        $sugestao->id_docente = $sessao[0]->id_pessoa;
   
        if($sugestao->save()){
            $info = 'Sucesso';
        }else{
            $info = 'Erro';
        }
        echo $info;        

    }
}
