<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PredefinidoAvaliacao;
use Illuminate\Support\Facades\DB;

class PredefinidoAvaliacaoController extends Controller
{
    public function pegaPredefinidaAvaliacao(){
        //Dados da sessão
        $sessao=session('dados_logado');

        $predefinidas = DB::table('predefinidoavaliacao')
                ->select('id','avaliacao','descricao')    
                ->where('id_departamento','=',$sessao[0]->id_departamento)
                ->get();
        return view('configuracao.predefinidaAvaliacaoTable',compact('predefinidas'));
    }

    public function registarPredefinidaAvaliacao(Request $request){
        $validatedData = $request->validate([
            'avaliacao' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
        ],[
            //Mensagens de validação de erros
            'avaliacao.required'=>'O nome da área é necessário',
            'descricao.required'=>'A descrição é necessária',
        ]);

        //Pega sessao
        $sessao=session('dados_logado');

        $predefinido = new PredefinidoAvaliacao;
        $predefinido->avaliacao = $request->avaliacao;
        $predefinido->descricao = $request->descricao; 
        $predefinido->id_departamento = $sessao[0]->id_departamento;
        
        if($predefinido->save()){
            $info = 1;
        }else{
            $info = 0;
        }
        echo $info;        
    }

    public function eliminarPredefinida($id){
        $info = 0;
        if(DB::table('predefinidoavaliacao')->where('id',$id)->delete()){
            $info = 1;
        }
        echo $info;
    }

    public function editarPredefinida(Request $request){
        $predefinida = PredefinidoAvaliacao::find($request->id);
        $predefinida->avaliacao=$request->avaliacao;
        $predefinida->descricao=$request->descricao;

        $info=0;

        if($predefinida->save()){
            $info = 1;
        }
        echo $info;     
    }

    public function pegaPredefinidaDepartamento(){
        $sessao=session('dados_logado');
        $predefinidas = PredefinidoAvaliacao::where('id_departamento','=',$sessao[0]->id_departamento)->get();
    }
}
