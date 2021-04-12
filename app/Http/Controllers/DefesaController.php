<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Predefesa;
use Illuminate\Support\Facades\DB;

class DefesaController extends Controller
{
    public function registarPredefesa(Request $request){
        $validatedData = $request->validate([
            'avaliacao' => ['required', 'integer', 'max:3'],
            'tipo' => ['required', 'integer', 'max:2'],
            'nota' => ['required'],
            'datapredefesa' => ['required','date'],
            'trabalho_id' => ['required'],
        ],[
            //Mensagens de validação de erros
            'avaliacao.required'=>'Por favor, informe a avaliacao',
            'tipo.required'=>'Por favor, informe o tipo',
            'nota.required'=>'Por favor, informe a nota',
            'datapredefesa.required'=>'Por favor, informe a Data da predefesa',
            'trabalho_id.required'=>'Por favor, informe o id do trabalho',
            
        ]);

        if(Predefesa::verificarPredefesa($request->trabalho_id,$request->datapredefesa)>0){
            echo '2';
        }else{
            $predefesa = new Predefesa;
            $predefesa->avaliacao=$request->avaliacao;
            $predefesa->tipo=$request->tipo;
            $predefesa->nota=$request->nota;
            $predefesa->id_trabalho=$request->trabalho_id;
            $predefesa->created_at=$request->datapredefesa;

            if($predefesa->save()){
                echo 'Sucesso';
            }
        }
    }

    public function listarPredefesaTrabalho($Trabalho_id){
        $predefesas = Predefesa::where('id_trabalho',$Trabalho_id)->orderBy('created_at','desc')->get();
        
        foreach($predefesas as $predefesa){
            if($predefesa->tipo==1)
                $predefesa->tipo='Teórica';
            if($predefesa->tipo==2)
                $predefesa->tipo='Prática';
            if($predefesa->avaliacao==0)
                $predefesa->avaliacao='Negativa';
            if($predefesa->avaliacao==1)
                $predefesa->avaliacao='Positiva';
            if($predefesa->avaliacao==2)
                $predefesa->avaliacao='Medíocre';
        }
        
        return view('tema.predefesaTable', compact('predefesas'));
    }

    public function editarPredefesa(Request $request){
        $validatedData = $request->validate([
            'avaliacao_edit' => ['required', 'integer', 'max:3'],
            'tipo_edit' => ['required', 'integer', 'max:2'],
            'nota_edit' => ['required'],
            'datapredefesa_edit' => ['required','date'],
            'predefesaid_edit' => ['required'],
        ],[
            //Mensagens de validação de erros
            'avaliacao_edit.required'=>'Por favor, informe a avaliacao',
            'tipo_edit.required'=>'Por favor, informe o tipo',
            'nota_edit.required'=>'Por favor, informe a nota',
            'datapredefesa_edit.required'=>'Por favor, informe a Data da predefesa',
            'predefesaid_edit.required'=>'Em falta o id da predefesa',
            
        ]);
        
        if(Predefesa::verificarPredefesa($request->trabalho_id,$request->datapredefesa_edit)>0 && Predefesa::isSamePredefesaDate($request->predefesaid_edit,$request->datapredefesa_edit)<1){
            echo '2';
        }else{
            $predefesa = Predefesa::find($request->predefesaid_edit);
            $predefesa->avaliacao=$request->avaliacao_edit;
            $predefesa->tipo=$request->tipo_edit;
            $predefesa->nota=$request->nota_edit;
            $predefesa->created_at=$request->datapredefesa_edit;

            if($predefesa->save()){
                echo 'Sucesso';
            }
        }
    }

    public function eliminarPredefesa($predefesa_id){
        if(DB::table('predefesa')->where('id', '=', $predefesa_id)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }
}
