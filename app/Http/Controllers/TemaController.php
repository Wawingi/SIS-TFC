<?php

namespace App\Http\Controllers;

use App\Model\Tema;

class TemaController extends Controller
{
    public function __construct()
    {

    }

    //Listar os temas a serem desenvolvidos pelos estudantes
    public function pegaTemas()
    {
        $temas = Tema::getTemas();
        return view('tema.TrabalhoEmCursoTable', compact('temas'));
    }

    //Ver um determinado tema (trabalho) a ser desenvolvido
    public function verTrabalho($id)
    {
        $id = base64_decode($id);
        $trabalho = Tema::getTema($id);
        return view('tema.verTrabalho', compact('trabalho'));
    }

    //ver os envolventes de um trabalho em desenvolvimento
    public function verEnvolventesTrabalho($idTrabalho)
    {
        $envolventes = Tema::getEnvolventes($idTrabalho);
        return view('tema.envolventesTable', compact('envolventes', 'estadoSugestao'));
    }
}
