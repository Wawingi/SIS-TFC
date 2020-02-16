<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
   protected $table = 'roles';

    //Função que pega role de um estande no acto do cadastro
    public static function pegaRole(){
        return DB::table('roles')->select('id','nome')->where('tipo',3)->get();
    } 
    //Função que pega as roles de um utilizador pesquisado ou da sessao logado
    public static function pegaRoleUtilizador($id){
        $roles = DB::table('pessoa')
        ->join('users', 'pessoa.id', '=', 'users.id_pessoa')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->select('role_user.id','roles.nome','roles.desc')
        ->where('pessoa.id','=',$id)
        ->get();

        return $roles;
    }
}
