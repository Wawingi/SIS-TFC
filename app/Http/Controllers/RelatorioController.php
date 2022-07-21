<?php

namespace App\Http\Controllers;
use App\Model\Pessoa;
use App\Model\NotaInformativa;
use App\Model\Provapublica;
use App\Model\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RelatorioController extends Controller
{
    public function listarOrientadores($id_departamento){
        $orientadores=Pessoa::getOrientadores($id_departamento);
        return view('relatorios.orientadoresTable',compact('orientadores'));
    }

    public function listarEditais($id_departamento){
        $editais=NotaInformativa::getEdital($id_departamento);
        return view('relatorios.editaisTable',compact('editais'));
    }

    public function listarProvasPublica($id_departamento){
        $provapublicas=Provapublica::getProvaPublica($id_departamento);
        return view('relatorios.provapublicaTable',compact('provapublicas'));
    }

    //Geração de PDFs
    public function baixar_relatorio_orientadores(Request $request){
        $orientadores=Pessoa::getOrientadores($request->departamento);
        if(count($orientadores)<1){
            return back()->with('info','Não foram encontrados dados relacionados.');
        }else{
            $logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$orientadores[0]->logotipo)));
            $pdf = PDF::loadView('pdf.orientadores',compact('orientadores','logotipo'));
            return $pdf->setPaper('a4')->stream('relatorio');
        }
    }

    public function baixar_Editais(Request $request){
        $editais=NotaInformativa::getEdital($request->departamento);
        if(count($editais)<1){
            return back()->with('info','Não foram encontrados dados relacionados.');
        }else{
            $logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$editais[0]->logotipo)));
            $pdf = PDF::loadView('pdf.editais',compact('editais','logotipo'));
            return $pdf->setPaper('a4','landscape')->stream('relatorio');
        }
    }

    public function baixar_Provapublica(Request $request){
        $provapublicas=Provapublica::getProvaPublica($request->departamento);
        if(count($provapublicas)<1){
            return back()->with('info','Não foram encontrados dados relacionados.');
        }else{
            $logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$provapublicas[0]->logotipo)));
            $pdf = PDF::loadView('pdf.provaspublica',compact('provapublicas','logotipo'));
            return $pdf->setPaper('a4')->stream('relatorio');  
        }
    }

    public function baixar_Linhas(Request $request){
        $linhas=Area::getAreasByDepartamento($request->departamento);
        if(count($linhas)<1){
            return back()->with('info','Não foram encontrados dados relacionados.');
        }else{
            $logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$linhas[0]->logotipo)));
            $pdf = PDF::loadView('pdf.linhasinvestigacao',compact('linhas','logotipo'));
            return $pdf->setPaper('a4')->stream('relatorio');  
        }
    }

    public function gerarActaDefesa($pessoa_id){
        $pessoa_id=base64_decode($pessoa_id);

        $anoActual = date('Y');

        $estudante = DB::table('pessoa')
                    ->join('estudante','estudante.id_pessoa','=','pessoa.id')
                    ->join('curso','estudante.id_curso','=','curso.id')
                    ->join('departamento','departamento.id','=','curso.id_departamento')
                    ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
                    ->join('trabalho_departamento','trabalho_departamento.id_departamento','=','departamento.id')
                    ->join('trabalho','trabalho.id','=','trabalho_departamento.id_trabalho')
                    ->join('nota_informativa','trabalho.id','=','nota_informativa.id_trabalho')
                    ->join('prova_publica','trabalho.id','=','prova_publica.id_trabalho')
                    ->select('faculdade.logotipo','faculdade.nome as faculdade','pessoa.nome as nome_estudante','departamento.nome as departamento','trabalho.tema','nota_informativa.local','nota_informativa.presidente','nota_informativa.secretario','nota_informativa.vogal_1','nota_informativa.vogal_2','prova_publica.nota','prova_publica.created_at as data_defesa')
                    ->where('estudante.id_pessoa',$pessoa_id)
                    ->first();
        
        if(is_null($estudante)){
            return back()->with('error','Acta não gerada por falta de realização da prova pública');
        }

        $presidente = Pessoa::getJuri($estudante->presidente);
        $vogal_1 = Pessoa::getJuri($estudante->vogal_1);
        $vogal_2 = Pessoa::getJuri($estudante->vogal_2);

        $estudante->logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$estudante->logotipo)));
        $estudante->logotipoUAN=base64_encode(file_get_contents(public_path('/images/faculdades/uan.png')));
        
        $pdf = PDF::loadView('pdf.actaDefesa',compact('estudante','anoActual','presidente','vogal_1','vogal_2'));
        return $pdf->setPaper('a4')->stream('Acta Defesa.pdf');  
    }
 
    //Gerar Relatório da sessão de defesa
    public function gerarActaSessaoDefesa($pessoa_id){
        $pessoa_id=base64_decode($pessoa_id);

        $anoActual = date('Y');

        $estudante = DB::table('pessoa')
                    ->join('estudante','estudante.id_pessoa','=','pessoa.id')
                    ->join('curso','estudante.id_curso','=','curso.id')
                    ->join('departamento','departamento.id','=','curso.id_departamento')
                    ->join('faculdade','faculdade.id','=','departamento.id_faculdade')
                    ->join('trabalho_departamento','trabalho_departamento.id_departamento','=','departamento.id')
                    ->join('trabalho','trabalho.id','=','trabalho_departamento.id_trabalho')
                    ->join('nota_informativa','trabalho.id','=','nota_informativa.id_trabalho')
                    ->join('prova_publica','trabalho.id','=','prova_publica.id_trabalho')
                    ->select('faculdade.logotipo','faculdade.nome as faculdade','pessoa.nome as nome_estudante','departamento.nome as departamento','trabalho.tema','nota_informativa.local','nota_informativa.presidente','nota_informativa.secretario','nota_informativa.vogal_1','nota_informativa.vogal_2','prova_publica.nota','prova_publica.created_at as data_defesa')
                    ->where('estudante.id_pessoa',$pessoa_id)
                    ->first();
        
        if(is_null($estudante)){
            return back()->with('error','Acta não gerada por falta de realização da prova pública');
        }

        $presidente = Pessoa::getJuri($estudante->presidente);
        $vogal_1 = Pessoa::getJuri($estudante->vogal_1);
        $vogal_2 = Pessoa::getJuri($estudante->vogal_2);

        $estudante->logotipo=base64_encode(file_get_contents(public_path('/images/faculdades/'.$estudante->logotipo)));
        $estudante->logotipoUAN=base64_encode(file_get_contents(public_path('/images/faculdades/uan.png')));
        
        $pdf = PDF::loadView('pdf.actaSessaoDefesa',compact('estudante','anoActual','presidente','vogal_1','vogal_2'));
        return $pdf->setPaper('a4')->stream('Acta Defesa.pdf');  
    }
}
