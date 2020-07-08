<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados_logado'); 
?>
@extends('layouts.inicio')
@section('content')
<div class="wrapper">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">SIS TFC</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilizadores</a></li>
                            <li class="breadcrumb-item active">Registar Utilizador</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- mensagens de validação de erros -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- fim de mensagens de validação de erros -->
        
        <!-- Alerta de inserção sucesso -->
        @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <!--Inicio do conteudo formulario funcionario-->
        <?php if($dados[0]->tipo==1){ ?>      
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-multiple-plus mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">REGISTAR FUNCIONÁRIO</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-multiple-plus mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">REGISTAR CHEFE DEPARTAMENTO</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Registo do funcionario-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">                                                    
                                                        <form method="post" id="validarFormularioFuncionario" action="{{ url('registarPessoa') }}">
                                                            @csrf
                                                            <!-- 1ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group mb-3">
                                                                        <label for="nome">Nome</label>
                                                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="bi">BI n.º</label>
                                                                        <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 2ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="data_nascimento">Data de nascimento</label>
                                                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 3ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Faculdade</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Genero</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                                            <label for="inlineRadio1"> Masculino </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="2" name="genero">
                                                                            <label for="inlineRadio2"> Feminino </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    $departamentos = App\Model\Departamento::where('id_faculdade',$dados[0]->id_faculdade)
                                                                                                            ->where('tipo',1)
                                                                                                            ->get();
                                                                ?>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Departamento</label>
                                                                        <select id="tipo" name="departamento" class="custom-select">
                                                                            <?php foreach($departamentos as $departamento): ?>
                                                                                <option>{{$departamento->nome}}</option>
                                                                            <?php endforeach ?>
                                                                        </select>                                            
                                                                    </div>
                                                                </div>                                   
                                                            </div>
                                                            <!-- 3ª Linha -->                           
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group mb-3">
                                                                        <label for="funcao">Função</label>
                                                                        <input type="text" class="form-control" name="funcao" id="funcao">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control" value="1" name="tipo">
                                                            <hr>

                                                            <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                                            <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Limpar</i></a>
                                                        </form>
                                                    </div> 
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <!-- Registo do chefe departamento-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="post" id="validarFormularioDocente" action="{{ url('registarPessoa') }}">
                                                            @csrf
                                                            <!-- 1ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group mb-3">
                                                                        <label for="nome">Nome</label>
                                                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="bi">BI n.º</label>
                                                                        <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 2ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="data_nascimento">Data de nascimento</label>
                                                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Genero</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                                            <label for="inlineRadio1"> Masculino </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="2" name="genero">
                                                                            <label for="inlineRadio2"> Feminino </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 3ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Faculdade</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <?php 
                                                                        $departamentos = App\Model\Departamento::where('id_faculdade',$dados[0]->id_faculdade)
                                                                                                                ->where('tipo',2)
                                                                                                                ->get();
                                                                    ?>
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Departamento</label>
                                                                        <select id="tipo" name="departamento" class="custom-select">
                                                                            <?php foreach($departamentos as $departamento): ?>
                                                                                <option>{{$departamento->nome}}</option>
                                                                            <?php endforeach ?>
                                                                        </select>                                                                          
                                                                    </div>
                                                                </div>                                                                                                                                                  
                                                            </div>
                                                            <!-- 4ª Linha -->   
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="funcao">Nível Académico</label>
                                                                        <select name="nivel_academico" class="custom-select">
                                                                            <option>Professor Assistente Estagiário</option>
                                                                            <option>Professor Assistente</option>
                                                                            <option>Professor Auxiliar</option>
                                                                            <option>Professor Titular</option>
                                                                        </select>                                          
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control" value="2" name="tipo">                                                      
                                                            <hr>
                                                            <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                                            <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Limpar</i></a>
                                                        </form>
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div>                         
                                    </div>

                                    <div class="clearfix"></div>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        <?php } else { ?>
         <!--Inicio do conteudo formulario docente e estudante-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <a href='{{ url("listarUtilizadores")}}' class="btn btn-outline-secondary waves-effect waves-light" data-overlayColor="#38414a"><i class="fe-users mr-1"></i> Listar Utilizadores</a></h4><br>
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-multiple-plus mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">REGISTAR DOCENTE</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-multiple-plus mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">REGISTAR ESTUDANTE</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Registo do docente-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">                                                    
                                                        <form method="post" id="validarFormularioDocente" action="{{ url('registarPessoa') }}">
                                                            @csrf
                                                            <!-- 1ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group mb-3">
                                                                        <label for="nome">Nome</label>
                                                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="bi">BI n.º</label>
                                                                        <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 2ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="data_nascimento">Data de nascimento</label>
                                                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Genero</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                                            <label for="inlineRadio1"> Masculino </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="2" name="genero">
                                                                            <label for="inlineRadio2"> Feminino </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 3ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Faculdade</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Departamento</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->departamento }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->departamento }}" name="departamento" required>
                                                                        <input type="hidden" class="form-control" value="{{ $dados[0]->id_departamento }}" name="id_departamento">
                                                                    </div>
                                                                </div>                                                                                                                                                  
                                                            </div>
                                                            <!-- 4ª Linha -->   
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="funcao">Nível Académico</label>
                                                                        <select name="nivel_academico" class="custom-select">
                                                                            <option>Professor Assistente Estagiário</option>
                                                                            <option>Professor Assistente</option>
                                                                            <option>Professor Auxiliar</option>
                                                                            <option>Professor Titular</option>
                                                                        </select>                                          
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" class="form-control" value="2" name="tipo">                                                      
                                                            <hr>
                                                            <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                                            <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Cancelar</i></a>
                                                        </form>
                                                    </div> <!-- end card-body-->
                                                </div> <!-- end card-->
                                            </div> 
                                        </div> 
                                    </div>
                                    <!-- Registo do estudante-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form method="post" id="validarFormularioEstudante" action="{{ url('registarPessoa') }}">
                                                            @csrf
                                                            <!-- 1ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <div class="form-group mb-3">
                                                                        <label for="nome">Nome</label>
                                                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="bi">BI n.º</label>
                                                                        <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 2ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="data_nascimento">Data de nascimento</label>
                                                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Genero</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                                            <label for="inlineRadio1"> Masculino </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="2" name="genero">
                                                                            <label for="inlineRadio2"> Feminino </label>
                                                                        </div>
                                                                    </div>
                                                                </div>                                               

                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="email">E-mail</label>
                                                                        <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 3ª Linha -->
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="telefone">Telefone</label>
                                                                        <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                                                    </div>
                                                                </div>
                                                            
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Faculdade</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Departamento</label>
                                                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->departamento }}" disabled required>
                                                                        <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->departamento }}" name="departamento" required>
                                                                        <input type="hidden" class="form-control" value="{{ $dados[0]->id_departamento }}" name="id_departamento">
                                                                    </div>
                                                                </div>        
                                                                
                                                            </div>
                                                            <!-- 4ª Linha -->
                                                            <?php 
                                                                $cursos = App\Model\Curso::where('id_departamento',$dados[0]->id_departamento)->get();
                                                            ?>                     
                                                            <div class="row">              
                                                                <div id="curso" class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="funcao">Curso</label>
                                                                        <select name="curso" class="custom-select">
                                                                        <?php foreach($cursos as $curso): ?>
                                                                            <option>{{$curso->nome}}</option>
                                                                        <?php endforeach ?>
                                                                        </select>                                          
                                                                    </div>
                                                                </div>
                                                                <div id="numero_mecanografico" class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="tipo">Número Mecanográfico</label>
                                                                        <input type="text" class="form-control" id="numero_mecanografico" name="numero_mecanografico">                     
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Periodo</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="Diurno" name="periodo" checked>
                                                                            <label for="inlineRadio1"> Diurno </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="Nocturno" name="periodo">
                                                                            <label for="inlineRadio2"> Nocturno </label>
                                                                        </div>
                                                                    </div>
                                                                </div>      
                                                                
                                                            </div>
                                                            <input type="hidden" class="form-control" value="3" name="tipo">
                                                            <hr>
                                                            <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                                            <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Cancelar</i></a>
                                                        </form>
                                                    </div> <!-- end card-body-->
                                                </div> <!-- end card-->
                                            </div> 
                                        </div>                         
                                    </div>

                                    <div class="clearfix"></div>
                                </div> <!-- tab-content -->
                            </div> <!-- end #btnwizard-->
                        </div> <!-- end card-body -->
                    </div>
                </div>
            </div>    
        <?php } ?>    
    </div> 
</div>

<script>
    // Validação do formulário do funcionário
    $( "#validarFormularioFuncionario" ).validate( {
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-Z\s]+$/
			},
			bi: {
				required: true,
                pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
				minlength:14,
                maxlength:14
			},
            data_nascimento: {
				required: true
			},
            telefone: {
				required: true
			},
            email: {
				required: true
			},
            funcao: {
				required: true
			}
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
			bi: {
                required: "O número do Bilhete deve ser fornecido.",
                pattern: "O padrão do bilhete está inválido.",
				minlength: "O tamanho mínimo deve ser 14 dígitos",
                maxlength: "O tamanho máximo deve ser 14 dígitos"
			},
            data_nascimento: {
				required: "A data de nascimento deve ser fornecida"
			},
            telefone: {
				required: "O número do telefone deve ser fornecido"
			},
            email: {
				required: "O email deve ser fornecido"
			},
            funcao: {
				required: "A função deve ser fornecida"
			}
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
    });    

    // Validação do formulário do docente
    $( "#validarFormularioDocente" ).validate( {
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-Z\s]+$/
			},
			bi: {
				required: true,
                pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
				minlength:14,
                maxlength:14
			},
            data_nascimento: {
				required: true
			},
            telefone: {
				required: true
			},
            email: {
				required: true
			}
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
			bi: {
                required: "O número do Bilhete deve ser fornecido.",
                pattern: "O padrão do bilhete está inválido.",
				minlength: "O tamanho mínimo deve ser 14 dígitos",
                maxlength: "O tamanho máximo deve ser 14 dígitos"
			},
            data_nascimento: {
				required: "A data de nascimento deve ser fornecida"
			},
            telefone: {
				required: "O número do telefone deve ser fornecido"
			},
            email: {
				required: "O email deve ser fornecido"
			}
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
    });

    // Validação do formulário do estudante
    $( "#validarFormularioEstudante" ).validate( {
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-Z\s]+$/
			},
			bi: {
				required: true,
                pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
				minlength:14,
                maxlength:14
			},
            data_nascimento: {
				required: true
			},
            telefone: {
				required: true
			},
            email: {
				required: true
			},
            numero_mecanografico: {
				required: true
			}
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
			bi: {
                required: "O número do Bilhete deve ser fornecido.",
                pattern: "O padrão do bilhete está inválido.",
				minlength: "O tamanho mínimo deve ser 14 dígitos",
                maxlength: "O tamanho máximo deve ser 14 dígitos"
			},
            data_nascimento: {
				required: "A data de nascimento deve ser fornecida"
			},
            telefone: {
				required: "O número do telefone deve ser fornecido"
			},
            email: {
				required: "O email deve ser fornecido"
			},
            numero_mecanografico: {
				required: "O número mecanográfico deve ser fornecido"
			}
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
    });
</script>
@stop