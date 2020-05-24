<?php

namespace App\Http\Controllers;

use App\Model\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pegaAreasAplicacao(){
        //Dados da sessão
        $sessao=session('dados_logado');

        $areas = DB::table('area_aplicacao')
        ->select('id','nome','deleted_at')    
        ->where('id_departamento','=',$sessao[0]->id_departamento)
        ->orderBy('nome')
        ->get();

        return view('configuracao.areaTable',compact('areas'));
    }

    public function registarArea(Request $request){
        $validatedData = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
        ],[
            //Mensagens de validação de erros
            'nome.required'=>'O nome da área é necessário',
        ]);

        //Pega sessao
        $sessao=session('dados_logado');

        $area = new Area;
        $area->nome = $request->nome;
        $area->visibilidade = 1;    //Visivel=1; Invisivel=2
        $area->id_departamento = $sessao[0]->id_departamento;
        
        if($area->save()){
            $info = 'Sucesso';
        }else{
            $info = 'Erro';
        }
        echo $info;        
    }

    public function editarArea(Request $request){
        if(DB::table('area_aplicacao')          
                ->where('id','=',$request->id_edit)
                ->update(['nome' => $request->input('nome_edit')])){
            $info = 'Sucesso';
        } else {
            $info = 'Erro';
        }
        echo $info;     
    }

    //Função que remove a area
    public function eliminarArea($id){
        if(DB::table('area_aplicacao')->where('id', '=', $id)->delete()){
            $info = 'Sucesso';
        }
        echo $info;
    }

    //Função que remove a area com softdelete (não permanente)
    public function softDeleteArea($id){
        if(Area::destroy($id)){
            $info = 'Sucesso';
        }
        echo $info;
    }

      //Função que restaura a area eliminada com softdelete
      public function restaurarArea($id){
        if(Area::withTrashed()
                ->where('id', $id)
                ->restore())
        {
            $info = 'Sucesso';
        }
        echo $info;
    }

    
}
