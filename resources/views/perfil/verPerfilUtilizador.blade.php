
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
                            <li class="breadcrumb-item active">Ver Perfil Utilizador</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <br><br>    
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="btn-group dropdown mt-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Menu</button>
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-chevron-down"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Desactivar conta</a>
                            <a class="dropdown-item" href="#">Editar perfil</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Associar a Perfil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">DADOS PESSOAIS</h4><hr>
                            <!-- Dados pessoais -->
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
                            </div>
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
                            <hr><h4 class="header-title">DADOS PROFISSIONAIS</h4><hr>
                            <!-- Dados profissionais -->
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
                            <hr><h4 class="header-title">DADOS DA CONTA</h4><hr>
                            <!-- Dados profissionais -->
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
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Estado</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->estado}}</label>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div> 
        <!--Fim do conteudo-->
    </div> 
</div>

@stop