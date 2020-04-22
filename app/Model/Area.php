<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $table = 'area_aplicacao';

    public static function pegaAreaId($nome,$id_departamento){
        return DB::table('area_aplicacao')
                    ->select('id')
                    ->where('nome',$nome)
                    ->where('id_departamento',$id_departamento)
                    ->value('id');
    }
}
