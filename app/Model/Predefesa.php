<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Predefesa extends Model
{
    protected $table = 'predefesa';

    public static function verificarPredefesa($Trabalho_id,$data_fornecida){
        return DB::table('predefesa')
            ->where('id_trabalho','=',$Trabalho_id)
            ->where(DB::raw('DATE(created_at)'),'=',$data_fornecida)
            ->count('id_trabalho');
    }
   
    public static function isSamePredefesaDate($predefesa_id,$data_fornecida){
        return DB::table('predefesa')
            ->where('id','=',$predefesa_id)
            ->where(DB::raw('DATE(created_at)'),'=',$data_fornecida)
            ->count('id_trabalho');
    }
}
