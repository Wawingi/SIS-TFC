<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PredefinidoAvaliacao extends Model
{
    protected $table = 'predefinidoavaliacao';

    //retorna os temas registados de um determinado orientador
    public static function getPredefinidaAvaliacao($id_item)
    {
         return DB::table('item')
             ->join('predefinidoavaliacao_item', 'predefinidoavaliacao_item.id_item', '=', 'item.id')
             ->join('predefinidoavaliacao', 'predefinidoavaliacao.id', '=', 'predefinidoavaliacao_item.id_predefinidoavaliacao')
             //->select('trabalho.id', 'trabalho.tema','trabalho.estado','area_aplicacao.nome', 'pessoa.nome as orientador')
             ->where('item.id',$id_item)
             ->get();
    }
}
