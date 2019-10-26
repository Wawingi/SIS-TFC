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
    Route::get('/registarUtilizador', function(){
        return view('gestao_organica.RegistarUtilizador');
    });
    Route::post('registarPessoa','FuncionarioFaculdadeController@registarPessoa');
});

//Rotas para Perfil do Utilizador
Route::name('utilizador')->group(function () {
    Route::get('verperfil', function(){
        return view('perfil.verPerfil');
    });   //Ver perfil do utilizador autenticado
    Route::get('verperfilUtilizador/{id}','PerfilController@verPerfilUtilizador'); //Ver perfil do utilizador pesquisado
    Route::get('listarUtilizadores','PerfilController@listarUtilizadores');
    Route::post('redefinirSenha','PerfilController@redefinirSenha');
});