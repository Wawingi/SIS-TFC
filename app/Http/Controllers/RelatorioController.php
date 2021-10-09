<?php

namespace App\Http\Controllers;
use App\Model\Pessoa;
use App\Model\NotaInformativa;
use App\Model\Provapublica;
use Illuminate\Http\Request;

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
}
