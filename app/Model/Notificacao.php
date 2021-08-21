<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notificacao extends Model
{
    protected $table = 'notificacao';

    public static function registarNotificacao($mensagem,$id_pessoa){
        $notificacao = new Notificacao;
        $notificacao->mensagem = $mensagem;
        $notificacao->estado = 0;
        $notificacao->id_pessoa = $id_pessoa;

        if($notificacao->save()){

        }
    }

    public static function getAllNotificacao($id_pessoa){
        return DB::table('notificacao')->orderBy('created_at','desc')->where('id_pessoa',$id_pessoa)->get();
    }
}
