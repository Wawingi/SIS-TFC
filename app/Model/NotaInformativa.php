<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Pessoa;

class NotaInformativa extends Model
{
    protected $table = 'nota_informativa';


    public static function getEdital($id_departamento){
        return DB::table('nota_informativa')
                ->join('trabalho', 'trabalho.id', '=', 'nota_informativa.id_trabalho')
                ->join('trabalho_departamento', 'trabalho_departamento.id_trabalho', '=', 'trabalho.id')
                ->join('departamento', 'trabalho_departamento.id_departamento', '=', 'departamento.id')
                ->join('faculdade', 'faculdade.id', '=', 'departamento.id_faculdade')
                ->join('envolvente', 'envolvente.id_trabalho', '=', 'trabalho.id')
                ->join('estudante', 'estudante.id_pessoa', '=', 'envolvente.id_estudante')
                ->join('pessoa', 'pessoa.id', '=', 'estudante.id_pessoa')
                ->select('pessoa.nome','trabalho.tema','nota_informativa.local','nota_informativa.created_at','nota_informativa.presidente','nota_informativa.secretario','nota_informativa.vogal_1','nota_informativa.vogal_2','faculdade.nome as faculdade','faculdade.logotipo','departamento.nome as departamento')
                ->where('departamento.id',$id_departamento)
                ->where('trabalho.estado',1)
                ->distinct('trabalho.tema')
                ->get();
    }

    public static function getNotaInformativa($id_trabalho){
        $ni = NotaInformativa::where('id_trabalho',$id_trabalho)->select('id','created_at','local','presidente','secretario','vogal_1','vogal_2')->first();
        $ni->presidente = Pessoa::getPessoaById($ni->presidente)->nome; 
        $ni->secretario = Pessoa::getPessoaById($ni->secretario)->nome; 
        $ni->vogal_1 = Pessoa::getPessoaById($ni->vogal_1)->nome; 
        $ni->vogal_2 = Pessoa::getPessoaById($ni->vogal_2)->nome; 
        
        return $ni;
    }
}
