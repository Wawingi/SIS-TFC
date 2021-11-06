<?php

namespace App\Http\Controllers;
use App\Model\Pessoa;
use App\Model\NotaInformativa;
use App\Model\Provapublica;
use App\Model\Area;
use Illuminate\Http\Request;
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
}
