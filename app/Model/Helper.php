<?php

namespace App\Model;

use File;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    //Mover proposta ou sugestão
    public static function moverFicheiro($ficheiro, $descricao, $id, $pasta)
    {
        $novoNome = $ficheiro->getClientOriginalName();
        $novoNome = Str_replace($novoNome, $descricao . $id . '.pdf', $novoNome);

        $ficheiro->storeAs('propostas', $novoNome);
        //$ficheiro->move(public_path('pdf/'.$pasta.'/'),$novoNome);

        return $novoNome;
    }

    //Mover itens do trabalho
    public static function moverItemFicheiro($anexo, $trabalho_tema, $trabalho_id,$titulo)
    {
        $novoNome = $anexo->getClientOriginalName();
        $novoNome = Str_replace($novoNome, $trabalho_tema .'_'. $trabalho_id .'_'. $titulo .'.pdf', $novoNome);
        
        $anexo->storeAs('propostas/itens', $novoNome);
       
        return $novoNome;
    }

    //Mover relatorios do trabalho
    public static function moverRelatorioFicheiro($anexo, $trabalho_tema, $trabalho_id)
    {
        $novoNome = $anexo->getClientOriginalName();
        $novoNome = Str_replace($novoNome, 'Relatorio_'.$trabalho_tema .'_'. $trabalho_id .'.pdf', $novoNome);
        
        $anexo->storeAs('trabalhos/', $novoNome);
       
        return $novoNome;
    }

    public static function eliminarFicheiro($ficheiro, $pasta)
    {
        $path = public_path('storage/' . $pasta . '/' . $ficheiro);
        if (File::exists($path)) {
            if (File::delete($path)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getFileSize($ficheiro)
    {
        return filesize($ficheiro) / 1024.0 / 1024.0;
    }

    public static function getFileExtension($ficheiro)
    {
        list($nome, $extensao) = explode(".", $ficheiro->getClientOriginalName());
        if ($extensao == 'pdf') {
            return true;
        } else {
            return false;
        }
    }
}
