<?php

namespace App\Http\Controllers;

use App\Model\Tema;

class TemaController extends Controller
{
    public function __construct()
    {

    }

    public function pegaTemas()
    {
        $temas = Tema::getTemas();

        return view('tema.TrabalhoEmCursoTable', compact('temas'));
        //return view('tema.listarTrabalhoEmCurso', compact('temas'));
    }
}
