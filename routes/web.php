<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/logar', 'Auth\LoginController@authenticate');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('alterarSenha', function(){
    return view('perfil.AlterarSenha');
});

//Rotas para Utilizador e Pessoa
Route::name('pessoa_registo')->group(function () {
    Route::get('registarUtilizador', 'UtilizadorController@registarUtilizador');
    Route::post('registarPessoa','UtilizadorController@registarPessoa');
});

//Rotas para Perfil do Utilizador
Route::name('utilizador')->group(function () {
    Route::get('verperfil', function(){
        return view('perfil.verPerfil');
    });   //Ver perfil do utilizador autenticado
    Route::get('verperfilUtilizador/{id}/{tipo?}','PerfilController@verPerfilUtilizador'); //Ver perfil do utilizador pesquisado
    Route::get('listarUtilizadores','PerfilController@listarUtilizadores');
    Route::post('redefinirSenha','PerfilController@redefinirSenha');
});

//Rotas para Departamentos
Route::name('departamento')->group(function () {
    Route::get('listarDepartamentos','DepartamentoController@index');
    Route::post('registarDepartamento','DepartamentoController@registarDepartamento');
});

Route::get('listarUsers', 'PerfilController@getUsers');