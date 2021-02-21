<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Helper;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function registarItem(Request $request){
        $request->validate([
            'titulo' => ['required', 'string', 'max:1'],
            'anexo' => ['required', 'mimes:pdf', 'max:2000'],
            'trabalho_id' => ['required'],
            'trabalho_tema' => ['required'],
        ], [
            //Mensagens de validação de erros
            'titulo.required' => 'O titulo é necessário',
            'anexo.required' => 'O ficheiro deve ser anexado.',
        ]);

        //Definir o tipo de item
        if($request->titulo==1)
            $titulo='PRETEXTUAL';
        if($request->titulo==2)
            $titulo='TEXTUAL';
        if($request->titulo==3)
            $titulo='POSTEXTUAL'; 
            
            
        //Se existir um item, então apague-o primeiro
        $deleted = DB::table('item')
                ->where('id_trabalho', '=', $request->trabalho_id)
                ->where('titulo', '=', $request->titulo)
                ->delete();


        //Verificar a extensão e o tamanho do ficheiro a anexar
        if ($request->file('anexo')->isValid()) {
            $novoFicheiro = Helper::moverItemFicheiro($request->file('anexo'),$request->trabalho_tema,$request->trabalho_id,$titulo); 
            
            $item = new Item;
            $item->titulo=$request->titulo;
            $item->anexo=$novoFicheiro;
            $item->id_trabalho=$request->trabalho_id;
            $item->avaliacao=3;

            if($item->save()){
                echo $request->titulo;
            }
        }
    
    }

    //Retorna um determinado elemento em função do tipo Pre,Tex,Pos Textual
    public function pegaElemento($id_Trabalho,$tipo_item){
        $elemento = DB::table('item')
                    ->where('id_trabalho','=',$id_Trabalho)
                    ->where('titulo','=',$tipo_item)
                    ->first();
        
                    if(is_object($elemento)) 
                        return view('tema.elementoTable',compact('elemento'));
    }

    //Abrir o pdf de um item anexado
    public function abrirItem($idItem){
        $idItem = base64_decode($idItem);
        $ficheiro = DB::table('item')->where('id',$idItem)->select('anexo','titulo')->first();
        return view('tema.abrirItem',compact('ficheiro'));
    }

    //Avaliar um item ou elemento adicionado
    public function avaliarItem(Request $request){
        //dd($request);
        $item = Item::find($request->id_item);
        $item->avaliacao = $request->avaliacao;
        $item->comentario = $request->comentario;
        if($item->save()){
            echo 'Sucesso';
        }; 
    }
}
