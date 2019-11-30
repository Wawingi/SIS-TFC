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
                            <li class="breadcrumb-item active">Ver Perfil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <br><br>    
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="btnwizard">
                        <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                            <li class="nav-item">
                                <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                    <i class="mdi mdi-account-circle mr-1"></i>
                                    <span class="d-none d-sm-inline">Dados Pessoais</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                    <i class="mdi mdi-settings mr-1"></i>
                                    <span class="d-none d-sm-inline">Dados Profissionais</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#tab32" data-toggle="tab" class="nav-link pt-2 pb-2">
                                    <i class="mdi mdi-account-badge-horizontal mr-1"></i>
                                    <span class="d-none d-sm-inline">Dados da Conta</span>
                                </a>
                            </li>
                        </ul>
                        <hr>            
                        <div class="tab-content mb-0 b-0">

                            <div class="tab-pane fade" id="tab12">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Nome</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">                       
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->nome}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Data de nascimento</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->data_nascimento}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> BI ou Passaporte n.º</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->bi}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Género</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->genero}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane fade" id="tab22">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Faculdade</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->faculdade}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Função</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->funcao}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Tipo de conta</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{ strtoupper($dados[0]->tipo)}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            </div>

                            <div class="tab-pane fade" id="tab32">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> E-mail</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->email}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Telefone</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->telefone}}</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Pefil de conta</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: Administrador</label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                
                            </div>
                    
                            <div class="clearfix"></div>
                            <hr>
                        </div> <!-- tab-content -->
                    </div> <!-- end #btnwizard-->
                    <button type="submit" class="btn btn-warning waves-effect waves-light"><i class="fas fa-user-edit mr-1"></i>Editar</button>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
        <!--Fim do conteudo-->

        <!-- VUE JS -->
        <div id="app">
            <div class="col-xl-12">
                <dados_perfil></dados_perfil>
            </div>
        </div>
        <!----------->

    </div> 
</div>


@stop