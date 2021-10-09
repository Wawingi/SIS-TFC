<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Notificacao;

class NotificacaoController extends Controller
{
    public function pegaNotificacoes(){
        $sessao = session('dados_logado');
        $contNotificacao = Notificacao::getAllNotificacao($sessao[0]->id_pessoa)->count('id');
        $notificacoes = DB::table('notificacao')->orderBy('created_at','desc')->where('id_pessoa',$sessao[0]->id_pessoa)->paginate(5);
        return view('notificacao.notificacaoTable', compact('notificacoes','contNotificacao'));
    }

    public function listarNotificacoes(){
        $sessao = session('dados_logado');
        $notificacoes = Notificacao::getAllNotificacao($sessao[0]->id_pessoa);
        return view('notificacao.listarNotificacoes', compact('notificacoes'));
    }

    public function marcarNotificacao($id_notificacao){
        $notificacao = Notificacao::find(base64_decode($id_notificacao));
        $notificacao->estado = 1;
        if($notificacao->save()){
            return back()->with('info', 'Notificação marcada como lida com sucesso.');
        }else{
            return back()->with('error', 'Erro ao marcar a notificação como lida.');
        }
    }

    public function eliminarNotificacao($id_notificacao){
        if(DB::table('notificacao')->where('id',base64_decode($id_notificacao))->delete()){
            return back()->with('info', 'Notificação eliminada com sucesso.');
        }else{
            return back()->with('error', 'Erro ao eliminar a notificação.');
        }
    }
}
