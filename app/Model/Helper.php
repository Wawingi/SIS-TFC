<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use File;

class Helper extends Model
{
    public static function moverFicheiro($ficheiro,$descricao,$id,$pasta){
        $novoNome = $ficheiro->getClientOriginalName();
        $novoNome = Str_replace($novoNome,$descricao.$id.'.pdf',$novoNome);

        $ficheiro->move(public_path('pdf/'.$pasta.'/'),$novoNome);

        return $novoNome;
    }

    public static function eliminarFicheiro($ficheiro,$pasta){
        $path = public_path('pdf/'.$pasta.'/'.$ficheiro);
        if(File::exists($path)){
            if(File::delete($path)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public static function getFileSize($ficheiro){
        return filesize($ficheiro)/1024.0/1024.0;
    }

    public static function getFileExtension($ficheiro){
        list($nome,$extensao) = explode(".",$ficheiro->getClientOriginalName());
        if($extensao=='pdf'){
            return true;
        }else{
            return false;
        }
    }
}
