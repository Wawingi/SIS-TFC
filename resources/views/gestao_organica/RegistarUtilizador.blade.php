<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados'); 
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
                    <h4 class="page-title"><?php echo strtoupper(Auth::user()->tipo) ?></h4><hr>
                </div>
            </div>
        </div>
        
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

        <!--Inicio do conteudo-->     
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">REGISTAR UTILIZADOR</h4><hr>
                        <form method="post" action="{{ url('registarPessoa') }}" class="needs-validation" novalidate>
                            @csrf
                            <!-- 1ª Linha -->
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group mb-3">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="bi">BI n.º</label>
                                        <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 2ª Linha -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="data_nascimento">Data de nascimento</label>
                                        <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="telefone">Telefone</label>
                                        <input type="number" class="form-control" name="telefone" id="telefone" placeholder="Informe o número telefónico" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="informe o email" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3ª Linha -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="tipo">Faculdade</label>
                                        <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" disabled required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="genero">Genero</label><br>
                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                            <input type="radio" id="inlineRadio1" value="M" name="genero" checked>
                                            <label for="inlineRadio1"> Masculino </label>
                                        </div>
                                        <div class="radio form-check-inline">
                                            <input type="radio" id="inlineRadio2" value="F" name="genero" checked>
                                            <label for="inlineRadio2"> Feminino </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group mb-3">
                                        <label for="tipo">Tipo</label>
                                        <input id="inputblock" type="text" class="form-control" value="{{ strtoupper($dados[0]->tipo ) }}" name="tipo" id="tipo" disabled required>
                                    </div>
                                </div>
                            </div>
                            <!-- 3ª Linha -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="funcao">Função</label>
                                        <input type="text" class="form-control" name="funcao" id="funcao" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-primary"><i class="far fa-save"> Registar</i></button>
                            <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning"><i class="far fa-save"> Cancelar</i></a>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>    
        <!--Fim do conteudo-->
    </div> 
</div>
@stop