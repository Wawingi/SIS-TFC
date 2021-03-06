<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = 'area_aplicacao';

    use SoftDeletes;

    public static function pegaAreaId($nome,$id_departamento){
        return DB::table('area_aplicacao')
                    ->select('id')
                    ->where('nome',$nome)
                    ->where('id_departamento',$id_departamento)
                    ->value('id');
    }
}
