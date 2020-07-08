<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{ 
    public function roles(){
        return $this->belongsToMany(\App\Role::class);
    }

     //Função que pega todas permissions
    public static function getPermissions($tipoRole){
        //0-todos,1-Funcionario,2-Docente,3-Estudante,12-Funcionario e Docente,23-Docente e Estudante
        //sessão dos dados do utilizador logado
        $sessao=session('dados_logado');
        if($sessao[0]->tipo==1){
             return DB::table('permissions')
                    ->select('id','nome','desc')
                    ->where('tipo',1)
                    ->orwhere('tipo',12)
                    ->get();
        }
        else if($sessao[0]->tipo==2 && $tipoRole==2){
            return DB::table('permissions')
                   ->select('id','nome','desc')
                   ->where('tipo',2)
                   ->orwhere('tipo',12)
                   ->orwhere('tipo',23)
                   ->get();
        }else if($sessao[0]->tipo==2 && $tipoRole==3){
            return DB::table('permissions')
                   ->select('id','nome','desc')
                   ->where('tipo',3)
                   ->orwhere('tipo',23)
                   ->get();
        }        
    }

    //Função que mostra se uma perfil ja possui uma permission
    public static function isDefinedPermissionRole($idPermission,$idRole){
        return DB::table('permission_role')
                ->where('permission_id',$idPermission)
                ->where('role_id',$idRole)
                ->count();
    }
}
