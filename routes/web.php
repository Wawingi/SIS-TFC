<?php

Route::get('/', function () {
    return view('auth.login');
});

Route::post('logar', 'Auth\LoginController@authenticate');

Auth::routes(['register' => false]);

Route::get('home', 'HomeController@index')->name('home');
Route::get('alterarSenha', function(){
    return view('perfil.AlterarSenha');
});

Route::get('listarUsers', 'PerfilController@getUsers');

//Rotas para Utilizador e Pessoa
Route::name('pessoa_registo')->group(function () {
    //Route::get('registarUtilizador', 'UtilizadorController@registarUtilizador');
    Route::get('registarUtilizador', function(){
        if(Gate::denies('criar_user'))
            return redirect()->back();    

        return view('perfil.RegistarUtilizador');
    });
    Route::post('registarPessoa','UtilizadorController@registarPessoa');
    Route::post('editarPessoa','UtilizadorController@editarPessoa');
});

//Rotas para Perfil do Utilizador
Route::name('utilizador')->group(function () {
    Route::get('verperfil','PerfilController@verPerfil');
    Route::get('verperfilUtilizador/{id}/{tipo?}','PerfilController@verPerfilUtilizador'); //Ver perfil do utilizador pesquisado
    Route::get('listarUtilizadores','PerfilController@listarUtilizadores');
    Route::post('redefinirSenha','PerfilController@redefinirSenha');
    Route::post('desactivarConta','PerfilController@desactivarConta');
    Route::post('atribuirPerfil','PerfilController@atribuirPerfil');
    Route::get('eliminarRoleUser/{id}','PerfilController@eliminarRoleUser');
    Route::get('pegaRoleUtilizador/{id}','PerfilController@pegaRoleUtilizador');
    Route::get('pegaUtilizador/{id}/{tipo?}','UtilizadorController@pegaUtilizador');
    Route::get('pesquisarUtilizador', function(){
        return view('perfil.pesquisarUtilizador');
    });
    Route::post('pesquisarUtilizador','PerfilController@pesquisarUtilizador');
});

//Rotas para Departamentos
Route::name('departamento')->group(function () {
    Route::get('listarDepartamentos','DepartamentoController@index');
    Route::post('registarDepartamento','DepartamentoController@registarDepartamento');
    Route::post('editarDepartamento','DepartamentoController@editarDepartamento');
    Route::get('pegaDepartamentos','DepartamentoController@pegaDepartamentos');
    Route::get('eliminarDepartamento/{id}','DepartamentoController@eliminarDepartamento');
    Route::get('pegaDepartamento/{id}','DepartamentoController@pegaDepartamento');
    Route::get('verDepartamento/{id}','DepartamentoController@verDepartamento');
    Route::get('pesquisarDepartamento', function(){
        return view('departamento.pesquisarDepartamento');
    });
    Route::post('pesquisarDepartamento','DepartamentoController@pesquisarDepartamento');
});

//Rotas para Cursos
Route::name('curso')->group(function () {
    Route::get('pegaCursos/{id}','CursoController@pegaCursos');
    Route::post('registarCurso','CursoController@registarCurso');
    Route::get('eliminarCurso/{id}','CursoController@eliminarCurso');
    Route::get('pegaCurso/{id}','CursoController@pegaCurso');
    Route::post('editarCurso','CursoController@editarCurso');
});

//Rotas para sugestões
Route::name('sugestao')->group(function () {
    Route::post('registarSugestao','SugestaoController@registarSugestao');
    Route::post('trabalharSugestao','SugestaoController@trabalharSugestao');
    Route::get('listarSugestaoDepartamento', function(){
        return view('sugestao.listarSugestaoDepartamento');
    });
    Route::get('pegaSugestoesDPTO','SugestaoController@pegaSugestoesDepartamento');
    Route::get('verSugestao/{id}','SugestaoController@verSugestao');

    Route::get('listarSugestaoEstudante', function(){
        return view('sugestao.listarSugestaoEstudante');
    });
    Route::get('pegaSugestoesEstudante','SugestaoController@pegaSugestoesEstudante');
    Route::get('verEnvolventes/{id}','SugestaoController@verEnvolventes');
    Route::get('sairGrupo/{idsugestao}/{idpessoa}','SugestaoController@sairGrupo');
    
});

//Rotas para configurações
Route::name('configuracao')->group(function (){
    Route::get('listarAreaAplicacao', function(){
        return view('configuracao.listarAreaAplicacao');
    });
    Route::get('pegaAreasAplicacao','AreaController@pegaAreasAplicacao');
    Route::post('registarArea','AreaController@registarArea');
    Route::post('editarArea','AreaController@editarArea');
    Route::get('eliminarArea/{id}','AreaController@softDeleteArea');
    Route::get('restaurarArea/{id}','AreaController@restaurarArea');
});


