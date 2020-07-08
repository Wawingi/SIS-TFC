<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
   protected $table = 'roles';
   use SoftDeletes;
    
   //Função que pega roles
    public static function pegaTodosRoles(){
        return DB::table('roles')->select('id','nome','desc')->where('tipo',1)->get();
    } 

    //Função que pega role de um estudante no acto do cadastro
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

     //Função que pega as permissions de uma role
     public static function pegaPermissionsRole($idRole){
        $roles = DB::table('roles')
        ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
        ->select('permissions.id','permissions.nome','permissions.desc')
        ->where('roles.id','=',$idRole)
        ->get();

        return $roles;
    }

}
