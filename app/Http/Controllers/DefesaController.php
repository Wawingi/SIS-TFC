<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Predefesa;
use App\Model\Provapublica;
use App\Model\NotaInformativa;
use App\Model\Tema;
use App\Model\Notificacao;
use App\Model\Pessoa;
use Illuminate\Support\Facades\DB;
use PDF;

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
                $predefesa->avaliacao='Baixa';
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

    //Secção da prova pública
    public function registarNotaInformativa(Request $request){
        $validatedData = $request->validate([
            'datadefesa' => ['required'],
            'local' => ['required','string'],
            'presidente' => ['required','string'],
            'secretario' => ['required','string'],
            'vogal_1' => ['required','string'],
            'vogal_2' => ['required','string'],
            'id_trabalho' => ['required','unique:nota_informativa'],
        ],[
            //Mensagens de validação de erros
            'datadefesa.required'=>'Por favor, informe a data da defesa.',
            'local.required'=>'Por favor, informe o local da realização da defesa',
            'presidente.required'=>'Por favor, informe o nome do presidente',
            'secretario.required'=>'Por favor, informe o nome do secretario',
            'vogal_1.required'=>'Por favor, informe o nome do 1º vogal',
            'vogal_2.required'=>'Por favor, informe o nome do 2º vogal',
            'id_trabalho.unique'=>'Este tema já possúi uma prova pública'
        ]);

        $checkPDF=DB::table('predefesa')->where('id_trabalho',$request->id_trabalho)->count();
        
        if($checkPDF<1)
            echo $checkPDF;
        else{
            $estudantes=Tema::getEstudanteTrabalhoID($request->id_trabalho);
            
            //Remover o T na data informada ex:2021-04-02T16:30
            $tiraT=Str_replace('T',' ',$request->datadefesa);
            $novadata=Str_replace($tiraT,$tiraT.':00',$tiraT);

            $provanotainformativa = new NotaInformativa;
            
            $provanotainformativa->created_at = $novadata;
            $provanotainformativa->local = $request->local;
            $provanotainformativa->presidente = $request->presidente;
            $provanotainformativa->secretario = $request->secretario;
            $provanotainformativa->vogal_1 = $request->vogal_1;
            $provanotainformativa->vogal_2 = $request->vogal_2;
            $provanotainformativa->id_trabalho = $request->id_trabalho;

            if($provanotainformativa->save()){
                foreach($estudantes as $estudante){
                    Notificacao::registarNotificacao('Foi publicado o edital contendo a data para a prova pública e a respectiva bancada examinadora. Navegue até ao seu trabalho e abra a aba Edital para ver mais detalhes.',$estudante->id_estudante);    
                }
                echo 1;
            }
        }
    }
     
    public function listarNotaInformativa($Trabalho_id){
        $notaInformativa = NotaInformativa::where('id_trabalho',$Trabalho_id)->first();
        if(is_object($notaInformativa)){
            $notaInformativa->presidente = Pessoa::getPessoaById($notaInformativa->presidente)->nome;
            $notaInformativa->secretario = Pessoa::getPessoaById($notaInformativa->secretario)->nome;
            $notaInformativa->vogal_1 = Pessoa::getPessoaById($notaInformativa->vogal_1)->nome;
            $notaInformativa->vogal_2 = Pessoa::getPessoaById($notaInformativa->vogal_2)->nome;
        }else{
            $notaInformativa = new NotaInformativa;
            $notaInformativa->presidente = null;
            $notaInformativa->secretario = null;
            $notaInformativa->vogal_1 = null;
            $notaInformativa->vogal_2 = null;
        }
        return view('tema.notainformativaTable', compact('notaInformativa'));
    }

    public function checkTrabalhoNotaInformativa($Trabalho_id){
        $notaInformativa = NotaInformativa::where('id_trabalho',$Trabalho_id)->count();
        return $notaInformativa;
    }
  
    public function checkTrabalhoProvaPublica($Trabalho_id){
        $provapublica = Provapublica::where('id_trabalho',$Trabalho_id)->count();
        return $provapublica;
    }

    public function eliminarNotaInformativa($id_Nota){
        if(DB::table('nota_informativa')->where('id','=',$id_Nota)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }

    //Secção da prova pública
    public function registarProvapublica(Request $request){
        $validatedData = $request->validate([
            'data_defesa' => ['required'],
            'nota_defesa' => ['required', 'integer','min:10','max:20'],
            'id_trabalho' => ['required','unique:prova_publica'],
            'id_nota' => ['required'],
            'local_defesa' => ['required'],
            'presidente_defesa' => ['required'],
            'secretario_defesa' => ['required'],
            'vogal_1_defesa' => ['required'],
            'vogal_2_defesa' => ['required'],
        ],[
            //Mensagens de validação de erros
            'data_defesa.required'=>'Por favor, informe a data da defesa.',
            'nota_defesa.required'=>'Por favor, informe a nota da defesa.',
            'nota.max'=>'A nota não deve exceder 20 valores.',
            'nota.min'=>'A nota não deve ser inferior a 0 valores.',
            'id_trabalho.unique'=>'Este tema já possúi uma prova pública',
        ]);

        $provapublica = new Provapublica;
        $provapublica->created_at = $request->data_defesa;
        $provapublica->nota = $request->nota_defesa;
        $provapublica->anotacao = $request->anotacao;
        $provapublica->id_trabalho = $request->id_trabalho;
        $provapublica->id_nota_informativa = $request->id_nota;


        if($provapublica->save()){
            //If work defendido, actualiza estado para defendido estado1=Em desenvolvimento ||2=Defendido
            if(DB::table('trabalho')          
            ->where('id','=',$request->id_trabalho)
            ->update(['estado' => 2]))
            {
                echo 1;
            }      
            echo 1;
        }
    }

    public function listarProvapublica($Trabalho_id){
        $provapublica = DB::table('prova_publica')
                            ->select('nota_informativa.local','nota_informativa.presidente','nota_informativa.secretario','nota_informativa.vogal_1','nota_informativa.vogal_2','prova_publica.id','prova_publica.nota','prova_publica.anotacao','prova_publica.created_at as data_defesa')
                            ->join('nota_informativa','nota_informativa.id','=','prova_publica.id_nota_informativa')                            
                            ->where('prova_publica.id_trabalho',$Trabalho_id)
                            ->first();
        if(is_object($provapublica)){
            $provapublica->presidente = Pessoa::getPessoaById($provapublica->presidente)->nome;
            $provapublica->secretario = Pessoa::getPessoaById($provapublica->secretario)->nome;
            $provapublica->vogal_1 = Pessoa::getPessoaById($provapublica->vogal_1)->nome;
            $provapublica->vogal_2 = Pessoa::getPessoaById($provapublica->vogal_2)->nome;
        }else{
            $provapublica = new Provapublica;
            $provapublica->presidente = null;
            $provapublica->secretario = null;
            $provapublica->vogal_1 = null;
            $provapublica->vogal_2 = null;
        }
        return view('tema.provapublicaTable', compact('provapublica'));
    }

    //EDITS da nota informativa
    public function editarLocalNotaInformativa(Request $request){
        $status=null;
        if(DB::table('nota_informativa')          
            ->where('id','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    public function editarJuradoNotaInformativa(Request $request){
        $status=null;
        if(DB::table('nota_informativa')          
            ->where('id','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    }

    //EDIT PROVA PÚBLICA
    public function editarProvaPublica(Request $request){
        $status=null;
        if(DB::table('prova_publica')          
            ->where('id','=',$request->pk)
            ->update([$request->name => $request->value]))
        {
            $status='sucesso';
        }      
        echo $status;               
    } 

    public function eliminarProvaPublica($id_prova){
        if(DB::table('prova_publica')->where('id','=',$id_prova)->delete()){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function abrirActaNota($id_prova){
        $pdf = PDF::loadView('pdf.actaNota',compact('id_prova'))->setOptions(['debugKeepTemp' => true, 'defaultFont' => 'sans-serif']);
        return $pdf->setPaper('a4')->stream('ACTA DA LEITURA DE NOTA.pdf');
    }
}
