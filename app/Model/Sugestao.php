<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sugestao extends Model
{
    protected $table = 'sugestao';

    public static function getSugestoes(){
        return DB::table('sugestao')
        ->select('tema','id_area','estado')    
        ->where('proveniencia','=',1)
        ->orderBy('tema')
        ->get();
    }
}
