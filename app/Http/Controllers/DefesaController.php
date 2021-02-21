<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Predefesa;

class DefesaController extends Controller
{
    public function registarPredefesa(Request $request){
        $validatedData = $request->validate([
            'avaliacao' => ['required', 'integer', 'max:1'],
            'tipo' => ['required', 'integer', 'max:1'],
            'recomendacao' => ['required'],
            'datapredefesa' => ['required','date'],
            'trabalho_id' => ['required'],
        ],[
            //Mensagens de validação de erros
            'avaliacao.required'=>'Por favor, informe a avaliacao',
            'tipo.required'=>'Por favor, informe o tipo',
            'recomendacao.required'=>'Por favor, informe a recomendacao',
            'datapredefesa.required'=>'Por favor, informe a Data da predefesa',
            'trabalho_id.required'=>'Por favor, informe o id do trabalho',
            
        ]);

        $predefesa = new Predefesa;
        $predefesa->avaliacao=$request->avaliacao;
        $predefesa->tipo=$request->tipo;
        $predefesa->recomendacao=$request->recomendacao;
        $predefesa->id_trabalho=$request->trabalho_id;
        $predefesa->created_at=$request->datapredefesa;

        if($predefesa->save()){
            echo 'Sucesso';
        }
    }
}
