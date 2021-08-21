<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Helper;
use App\Model\PredefinidoAvaliacao;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function registarItem(Request $request){
        $request->validate([
            'titulo' => ['required', 'string', 'max:1'],
            'anexo' => ['required', 'mimes:pdf', 'max:2000'],
            'trabalho_id' => ['required'],
            'trabalho_tema' => ['required'],
            'comentario' => ['required'],
        ], [
            //Mensagens de validação de erros
            'titulo.required' => 'O titulo é necessário',
            'anexo.required' => 'O ficheiro deve ser anexado.',
            'comentario.required' => 'O comentário deve ser anexado.',
        ]);

        //Definir o tipo de item
        if($request->titulo==1)
            $titulo='PRETEXTUAL';
        if($request->titulo==2)
            $titulo='TEXTUAL';
        if($request->titulo==3)
            $titulo='POSTEXTUAL'; 
                   
        //Se existir um item, então apague-o primeiro
        $item = DB::table('item')
                ->where('id_trabalho', '=', $request->trabalho_id)
                ->where('titulo', '=', $request->titulo)
                ->orderBy('created_at','desc')
                ->first();

        if(is_object($item)){
            if($item->avaliacao==1){
                echo 5;return; //Elemento já foi aprovado
            }
            if($item->avaliacao==3){
                echo 4;return;  //Elemento precisa ser avaliado
            }
            if($item->avaliacao==0){        
                //Verificar a extensão e o tamanho do ficheiro a anexar
                if ($request->file('anexo')->isValid()) {
                    $novoFicheiro = Helper::moverItemFicheiro($request->file('anexo'),$request->trabalho_tema,$request->trabalho_id,$titulo); 
                    
                    $item = new Item;
                    $item->titulo=$request->titulo;
                    $item->anexo=$novoFicheiro;
                    $item->id_trabalho=$request->trabalho_id;
                    $item->avaliacao=3;  //0:Negativa | 1: Positiva | 3: Neutro
                    $item->comentario=$request->comentario;  //0:Negativa | 1: Positiva | 3: Neutro
    
                    if($item->save()){
                        echo $request->titulo;
                    }
                }
            }
        }else{
            //Verificar a extensão e o tamanho do ficheiro a anexar
            if ($request->file('anexo')->isValid()) {
                $novoFicheiro = Helper::moverItemFicheiro($request->file('anexo'),$request->trabalho_tema,$request->trabalho_id,$titulo); 
                
                $item = new Item;
                $item->titulo=$request->titulo;
                $item->anexo=$novoFicheiro;
                $item->id_trabalho=$request->trabalho_id;
                $item->avaliacao=3;  //0:Negativa | 1: Positiva | 3: Neutro
                $item->comentario=$request->comentario;  //0:Negativa | 1: Positiva | 3: Neutro

                if($item->save()){
                    echo $request->titulo;
                }
            }
        }     
    }

    //Retorna um determinado elemento em função do tipo Pre,Tex,Pos Textual
    public function pegaElemento($id_Trabalho,$tipo_item){
        $elementos = DB::table('item')
                    ->where('id_trabalho','=',$id_Trabalho)
                    ->where('titulo','=',$tipo_item)
                    ->get();
        $pr=null;

        if(count($elementos)>0){
            $predefinidas = PredefinidoAvaliacao::getPredefinidaAvaliacao($elementos[0]->id);

            //Verificar se array de predefinidas possui dados, isto é tem avaliação negativa
            if(count($predefinidas)>0){
                $pr=' - '.$predefinidas[0]->descricao;
                for($i=1;$i<count($predefinidas);$i++){
                    $pr=$pr."\r\n".' - '.$predefinidas[$i]->descricao;
                }
            }
        }

        return view('tema.elementoTable',compact('elementos','pr'));
    }
    
    //Retorna as avaliações de um elemento
    public function pegaElementosAvaliacao($id_Trabalho){
        $avaliacoes = DB::table('item')
                    ->select('titulo','avaliacao')
                    ->where('id_trabalho','=',$id_Trabalho)
                    ->get();
        $pretextual=null;$textual=null;$postextual=null;
        
        foreach($avaliacoes as $av){
            if($av->titulo==1)
                $pretextual=$av->avaliacao;
            else if($av->titulo==2)
                $textual=$av->avaliacao;
            else if($av->titulo==3)
                $postextual=$av->avaliacao;
        }
       
        $avaliacoes = array("prTextual" => $pretextual,"textual" => $textual,"psTextual" => $postextual);
        return $avaliacoes;
    }

    //Abrir o pdf de um item anexado
    public function abrirItem($idItem){
        $idItem = base64_decode($idItem);
        $ficheiro = DB::table('item')->where('id',$idItem)->select('anexo','titulo')->first();
        return view('tema.abrirItem',compact('ficheiro'));
    }

    //Avaliar um item ou elemento adicionado
    public function avaliarItem(Request $request){
        $item = Item::find($request->id_item);
        $item->avaliacao = $request->avaliacao;
        $item->comentario = $request->comentario;
        if($item->save()){
            echo 'Sucesso';
        }; 
    }

    //Avaliar um item Avaliação=0 Positivo || Avaliação=1 Negativo
    public function registarAvaliacao(Request $request){
        $item = Item::find($request->id_item);

        if($request->avaliacao==1){
            $item->avaliacao = 1;
            $item->comentario = 'Este item teve aprovação.';
            if($item->save()){
                echo 1;
            }
        }else{
            $item->avaliacao = 0;
            $item->comentario = 'Este item deve ser revisto os seguintes pontos:';
            if($item->save()){
                //Associar item ao predefinidas
                foreach ($request->predefinidas as $predefinida):
                    DB::table('predefinidoavaliacao_item')->insert(
                        ['id_predefinidoavaliacao' => $predefinida,'id_item' => $item->id]
                    );
                endforeach;
                echo 1;
            }
        }
    }
}
