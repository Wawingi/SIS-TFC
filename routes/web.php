<?php

Route::get('/', function () {
    return view('auth.login');
});

//Rotas para Utilizador e Pessoa
Route::middleware(['auth'])->group(function () {
    //Route::get('registarUtilizador', 'UtilizadorController@registarUtilizador');
    Route::get('home', 'HomeController@index');
    Route::get('alterarSenha', function () {
        return view('perfil.AlterarSenha');
    });
    Route::get('registarUtilizador', function () {
        if (Gate::denies('criar_user')) {
            return redirect()->back();
        }
        return view('perfil.RegistarUtilizador');
    });
    Route::post('registarPessoa', 'UtilizadorController@registarPessoa');
    Route::post('editarPessoa', 'UtilizadorController@editarPessoa');
    Route::get('listarUsers', 'PerfilController@getUsers');
});

//Rotas para Perfil do Utilizador
Route::middleware(['auth'])->group(function () {
    Route::get('verperfil', 'PerfilController@verPerfil');
    Route::get('verperfilUtilizador/{id}/{tipo?}', 'PerfilController@verPerfilUtilizador'); //Ver perfil do utilizador pesquisado
    Route::get('listarUtilizadores', 'PerfilController@listarUtilizadores');
    Route::post('redefinirSenha', 'PerfilController@redefinirSenha');
    Route::post('desactivarConta', 'PerfilController@desactivarConta');
    Route::post('atribuirPerfil', 'PerfilController@atribuirPerfil');
    Route::get('eliminarRoleUser/{id}', 'PerfilController@eliminarRoleUser');
    Route::get('pegaRoleUtilizador/{id}', 'PerfilController@pegaRoleUtilizador');
    Route::get('pegaUtilizador/{id}/{tipo?}', 'UtilizadorController@pegaUtilizador');
    Route::get('pesquisarUtilizador', function () {
        return view('perfil.pesquisarUtilizador');
    });
    Route::post('pesquisarUtilizador', 'PerfilController@pesquisarUtilizador');
    Route::get('resetarSenha/{id}', 'PerfilController@resetarSenha');
    /*Route::get('trocarSenha', function(){
    return view('perfil.trocarSenha');
    });*/
    Route::post('trocarSenha', 'PerfilController@trocarSenha');
    Route::post('editarPessoa', 'UtilizadorController@editarPessoa');
    Route::post('editarNome', 'UtilizadorController@editarPessoa');
    Route::post('editarTelefone', 'UtilizadorController@editarPessoa');
    Route::post('editarUtilizador', 'UtilizadorController@editarUtilizador');
    Route::post('editarFuncionario', 'UtilizadorController@editarFuncionario');
    Route::post('editarFuncao', 'UtilizadorController@editarFuncao');
    Route::post('editarEstudante', 'UtilizadorController@editarEstudante');
    Route::post('editarCursoEstudante', 'UtilizadorController@editarCursoEstudante');
    Route::post('editarNivelAcademico', 'UtilizadorController@editarNivelAcademico');
    Route::post('editarDepartamentoFuncionario', 'UtilizadorController@editarDepartamentoFuncionario');
});

//Rotas para Departamentos
Route::middleware(['auth'])->group(function () {
    Route::get('listarDepartamentos', 'DepartamentoController@index')->middleware('can.see.departamento');
    Route::post('registarDepartamento', 'DepartamentoController@registarDepartamento');
    Route::post('editarDepartamento', 'DepartamentoController@editarDepartamento');
    Route::get('pegaDepartamentos/{isDeleted}', 'DepartamentoController@pegaDepartamentos');
    Route::get('eliminarDepartamento/{id}', 'DepartamentoController@eliminarDepartamento');
    Route::get('restaurarDepartamento/{id}', 'DepartamentoController@restaurarDepartamento');
    Route::get('pegaDepartamento/{id}', 'DepartamentoController@pegaDepartamento');
    Route::get('verDepartamento/{id}', 'DepartamentoController@verDepartamento');
    Route::get('pesquisarDepartamento', function () {
        return view('departamento.pesquisarDepartamento');
    });
    Route::post('pesquisarDepartamento', 'DepartamentoController@pesquisarDepartamento');
});

//Rotas para Cursos
Route::middleware(['auth'])->group(function () {
    Route::get('pegaCursos/{id}/{isDeleted}', 'CursoController@pegaCursos');
    Route::post('registarCurso', 'CursoController@registarCurso');
    Route::get('eliminarCurso/{id}', 'CursoController@eliminarCurso');
    Route::get('restaurarCurso/{id}', 'CursoController@restaurarCurso');
    //Route::get('pegaCurso/{id}','CursoController@pegaCurso');
    Route::post('editarCurso', 'CursoController@editarCurso');
});

//Rotas para sugestões
Route::middleware(['auth'])->group(function () {
    Route::post('registarSugestao', 'SugestaoController@registarSugestao');
    Route::post('trabalharSugestao', 'SugestaoController@trabalharSugestao');
    Route::get('listarSugestaoDepartamento', function () {
        return view('sugestao.listarSugestaoDepartamento');
    });
    Route::get('pegaSugestoesDPTO', 'SugestaoController@pegaSugestoesDepartamento');
    Route::get('verSugestao/{id}/{notificacao?}', 'SugestaoController@verSugestao');

    Route::get('listarSugestaoEstudante', function () {
        return view('sugestao.listarSugestaoEstudante');
    });
    Route::get('pegaSugestoesEstudante', 'SugestaoController@pegaSugestoesEstudante');
    Route::get('verEnvolventes/{id}/{estadoSugestao}', 'SugestaoController@verEnvolventes');
    Route::get('sairGrupo/{idsugestao}/{idpessoa}/{proveniencia}/{descricao}', 'SugestaoController@sairGrupo');
    Route::get('aceitarProposta/{idPessoa}/{idSugestao}', 'SugestaoController@aceitarProposta');
    Route::get('negarProposta/{idsugestao}/{idpessoa}/{proveniencia}', 'SugestaoController@negarProposta');
    Route::get('minhasPropostas', function () {
        return view('sugestao.minhasPropostas');
    });
    Route::get('pegaSugestoesOrientador', 'SugestaoController@pegaSugestoesOrientador');
    Route::get('contSugestoesOrientador', 'SugestaoController@contSugestoesOrientador');
    Route::post('rejeitarProposta', 'SugestaoController@rejeitarProposta');
    Route::get('verMotivoRejeicao/{idSugestao}', 'SugestaoController@verMotivoRejeicao');
    Route::get('aprovarProposta/{idSugestao}', 'SugestaoController@aprovarProposta');
    Route::post('adicionarEstudante', 'SugestaoController@adicionarEstudante');
    Route::post('trocarTutor', 'SugestaoController@trocarTutor');
    Route::get('listarConvitesSugestao', 'SugestaoController@listarConvitesSugestao');
});

//Rotas para temas ou trabalho
Route::middleware(['auth'])->group(function () {
    Route::get('trabalhoEmCurso', function () {
        return view('tema.listarTrabalhoEmCurso');
    });
    Route::get('trabalhoDefendido', function () {
        return view('tema.listarTrabalhoDefendido');
    });
    Route::get('meusTutorandos', function () {
        return view('tema.meusTutorandos');
    });
    Route::get('pegaTrabalhosOrientador', 'TemaController@pegaTrabalhosOrientador');
    Route::get('pegaTemas', 'TemaController@pegaTrabalhos');
    Route::get('pegaTrabalhosDefendidos', 'TemaController@pegaTrabalhosDefendidos');
    Route::get('verTrabalho/{id}', 'TemaController@verTrabalho');
    Route::get('verTrabalhoDefendido/{id}', 'TemaController@verTrabalhoDefendido');
    Route::get('verEnvolventesTrabalho/{id}', 'TemaController@verEnvolventesTrabalho');
    Route::post('registarRelatorioFinal','TemaController@registarRelatorioFinal');
    Route::get('verMeuTrabalho','TemaController@verMeuTrabalho');
    Route::post('registarItem','ItemController@registarItem');
    Route::get('pegaElemento/{idTrabalho}/{itemTipo}','ItemController@pegaElemento');
    Route::get('pegaElementosAvaliacao/{idTrabalho}','ItemController@pegaElementosAvaliacao');
    Route::get('abrirItem/{idItem}','ItemController@abrirItem');
    Route::post('avaliarItem','ItemController@avaliarItem');
});

//Rotas para configurações
Route::middleware(['auth'])->group(function () {
    Route::get('listarAreaAplicacao', function () {
        return view('configuracao.listarAreaAplicacao');
    });
    Route::get('pegaAreasAplicacao/{isDeleted}', 'AreaController@pegaAreasAplicacao');
    Route::post('registarArea', 'AreaController@registarArea');
    Route::post('editarArea', 'AreaController@editarArea');
    Route::get('eliminarArea/{id}', 'AreaController@softDeleteArea');
    Route::get('restaurarArea/{id}', 'AreaController@restaurarArea');
    Route::get('listarPerfilUtilizador', function () {
        return view('configuracao.listarPerfilUtilizador');
    });
    Route::post('registarPerfil', 'PerfilController@registarPerfil');
    Route::get('pegaPerfilUtilizador/{isDeleted}', 'PerfilController@pegaPerfilUtilizador');
    Route::post('editarPerfil', 'PerfilController@editarPerfil');
    Route::get('eliminarPerfil/{id}', 'PerfilController@softDeletePerfil');
    Route::get('restaurarPerfil/{id}', 'PerfilController@restaurarPerfil');
    Route::get('verRole/{id}/{nome}/{desc}/{tipo}', 'PerfilController@verRole');
    Route::get('removerPermissao/{idPermission}/{idRole}', 'PerfilController@removerPermissao');
    Route::post('associarPermission', 'PerfilController@associarPermission');
});

//Rotas para predefesas e defesas
Route::middleware(['auth'])->group(function () {
    Route::post('registarPredefesa', 'DefesaController@registarPredefesa');
    Route::post('editarPredefesa', 'DefesaController@editarPredefesa');
    Route::get('listarPredefesaTrabalho/{Trabalho_id}', 'DefesaController@listarPredefesaTrabalho');
    Route::get('eliminarPredefesa/{Predefesa_id}', 'DefesaController@eliminarPredefesa');
    Route::post('registarProvapublica', 'DefesaController@registarProvapublica');
    Route::post('registarNotaInformativa', 'DefesaController@registarNotaInformativa');
    Route::get('listarNotaInformativa/{Trabalho_id}', 'DefesaController@listarNotaInformativa');
    Route::get('checkTrabalhoNotaInformativa/{Trabalho_id}', 'DefesaController@checkTrabalhoNotaInformativa');
    Route::get('checkTrabalhoProvaPublica/{Trabalho_id}', 'DefesaController@checkTrabalhoProvaPublica');
    Route::get('eliminarNotaInformativa/{id_Nota}', 'DefesaController@eliminarNotaInformativa');
    Route::get('listarProvapublica/{Trabalho_id}', 'DefesaController@listarProvapublica');
    Route::post('editarLocal', 'DefesaController@editarLocalNotaInformativa');
    Route::post('editarJurado', 'DefesaController@editarJuradoNotaInformativa');
    Route::post('editarProvaPublica', 'DefesaController@editarProvaPublica');
    Route::get('eliminarProvaPublica/{id_prova}', 'DefesaController@eliminarProvaPublica');
});

Route::post('logar', 'Auth\LoginController@authenticate');

Auth::routes(['register' => false]);
