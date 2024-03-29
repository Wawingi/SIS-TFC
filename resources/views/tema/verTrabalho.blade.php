<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trabalho</a></li>
                            <li class="breadcrumb-item active">Ver Trabalho</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ver Trabalho</h4>
                </div>
            </div>
        </div>
        <!--Modal ver elemento-->
        @include('includes.trabalho.modalVerElementoPdf')
        @include('includes.trabalho.modalVerElemento')
        @include('includes.trabalho.modalAvaliarElemento')
        

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
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong>
                    {{ session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!--Inicio do conteudo-->
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#dados" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-book-open"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-book-open"></i> Dados</span>
                                            </a>
                                        </li>                                        
                                        <li class="nav-item">
                                            <a href="#evolucao" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-clipboard-list"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-clipboard-list"></i> Evolução do Trabalho</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#relatorio" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-file-pdf"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-file-pdf"></i> Relatório Final</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#predefesa" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-user-edit"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-user-edit"></i> Pré Defesas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#notainformativa" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-edit"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-edit"></i> Edital</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#provapublica" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-user-graduate"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-user-graduate"></i> Prova Pública</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <!-- Secção de dados do trabalho -->
                                <div class="tab-pane fade show active" id="dados">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                                                <li style="background:#fff;height:180px" id="task1" class="task-low">
                                                    <br>
                                                    <input type="hidden" name="trabalho_id" id="trabalho_id" class="form-control" value="{{$trabalho->id}}">
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-4">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Tema</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$trabalho->tema}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-4">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Área de aplicação</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$trabalho->area}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-4">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-6 col-form-label"> Data de aprovação</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{ date('d/m/Y',strtotime($trabalho->created_at)) }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-4">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Orientador</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$trabalho->docente}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-4">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Estado</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">:
                                                                    @if($trabalho->estado==1)
                                                                        <span style="color:#297BED" >Em desenvolvimento</span> <i style="color:#297BED" class='fas fa-directions mr-3'></i>
                                                                    @elseif($trabalho->estado==2)
                                                                        <span class="check">Defendido</span> <i style="color:#007c00" class='fas fa-check-circle mr-3'></i>
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <h5 class="table-title"><i class="fas fa-users mr-1"></i>ESTUDANTES ENVOLVIDOS</h5><hr>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome</th>
                                                                <th>BI Nº</th>
                                                                <th>Curso</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="dataTable">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- Secção da evolução do trabalho -->
                                <div class="tab-pane fade" id="evolucao">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div id="accordion" class="mb-3">
                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" title="Clique aqui para expandir" data-toggle="collapse" href="#" aria-expanded="true">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS PRÉ-TEXTUAIS
                                                            </a>
                                                            @can('add_item')
                                                                <a id="showBtnAdicionar1" class="float-right btn btn-success btn-sm btn-rounded" data-toggle="collapse" href="#" onclick="mudaAnexoElemento(1)"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Item</a>
                                                                <a id="showBtnCancelar1" style="display:none" class="float-right" data-toggle="collapse" href="#" onclick="fecharAnexo(1)"><i class="mdi mdi-close mr-1"></i>Cancelar</a>
                                                            @endcan
                                                        </h5>
                                                    </div>
                                        
                                                    <div>
                                                        <div class="card-body">
                                                            <div id="showAnexo1" style="display:none" class="row">
                                                                <div class="col-12">
                                                                    <form class="formElemento" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">    
                                                                        <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="trabalho_tema" id="trabalho_tema">    
                                                                        <input required type="hidden" value="1" class="form-control" name="titulo" id="titulo">    
                                                                        <div class="input-group">
                                                                            <input type="file" required class="form-control form-control-sm" placeholder="Escolha o ficheiro" accept="application/pdf" id="anexo" name="anexo">  
                                                                        </div>
                                                                        <span style="color:red;font-style:italic">tamanho máximo 2Mb</span>
                                                                        <textarea required style="margin-top:10px" placeholder="Escreva o que foi feito neste elemento" class="form-control form-control-sm" name="comentario" rows="3"></textarea> 
                                                                        <br><button type="submit" class="btn btn-sm btn-primary btn-rounded"><i class="far fa-save"> Registar </i></button>    
                                                                        <hr>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody class="tablePretextual">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim Elemento Pre Textual-->
                                                
                                                <!-- Inicio Elemento Textual-->
                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingTwo">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" title="Clique aqui para expandir" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS TEXTUAIS
                                                            </a>
                                                            @can('add_item')
                                                                <a id="showBtnAdicionar2" class="float-right btn btn-success btn-sm btn-rounded" href="#" onclick="mudaAnexoElemento(2)"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Item</a>
                                                                <a id="showBtnCancelar2" style="display:none" class="float-right" href="#" onclick="fecharAnexo(2)"><i class="mdi mdi-close mr-1"></i>Cancelar</a>
                                                            @endcan
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <div class="card-body">
                                                            <div id="showAnexo2" style="display:none" class="row">
                                                                <div class="col-12">
                                                                    <form class="formElemento" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">    
                                                                        <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="trabalho_tema" id="trabalho_tema">    
                                                                        <input required type="hidden" value="2" class="form-control" name="titulo" id="titulo">    
                                                                        <div class="input-group">
                                                                            <input type="file" required class="form-control form-control-sm" placeholder="Escolha o ficheiro" accept="application/pdf" id="anexo" name="anexo">
                                                                        </div>
                                                                        <span style="color:red;font-style:italic">tamanho máximo 2Mb</span>
                                                                        <textarea required style="margin-top:10px" placeholder="Escreva o que foi feito neste elemento" class="form-control form-control-sm" name="comentario" rows="3"></textarea> 
                                                                        <br><button type="submit" class="btn btn-sm btn-primary btn-rounded"><i class="far fa-save"> Registar </i></button>    
                                                                        <hr>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody class="tableTextual">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim Elemento Textual-->
                                                
                                                <!-- Inicio Elemento PosTextual-->
                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" title="Clique aqui para expandir" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS PÓS-TEXTUAIS
                                                            </a>
                                                            @can('add_item')
                                                                <a id="showBtnAdicionar3" class="float-right btn btn-success btn-sm btn-rounded" href="#" onclick="mudaAnexoElemento(3)"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Item</a>
                                                                <a id="showBtnCancelar3" style="display:none" class="float-right" href="#" onclick="fecharAnexo(3)"><i class="mdi mdi-close mr-1"></i>Cancelar</a>
                                                            @endcan
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <div class="card-body">
                                                            <div id="showAnexo3" style="display:none" class="row">
                                                                <div class="col-12">
                                                                    <form class="formElemento" action="{{url('registarItemmm')}}" method="post" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">    
                                                                        <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="trabalho_tema" id="trabalho_tema">    
                                                                        <input required type="hidden" value="3" class="form-control" name="titulo" id="titulo">    
                                                                        <div class="input-group">
                                                                            <input type="file" required class="form-control form-control-sm" placeholder="Escolha o ficheiro" accept="application/pdf" id="anexo" name="anexo">
                                                                        </div>
                                                                        <span style="color:red;font-style:italic">tamanho máximo 2Mb</span>
                                                                        <textarea required style="margin-top:10px" placeholder="Escreva o que foi feito neste elemento" class="form-control form-control-sm" name="comentario" rows="3"></textarea> 
                                                                        <br><button type="submit" class="btn btn-sm btn-primary btn-rounded"><i class="far fa-save"> Registar </i></button>    
                                                                        <hr>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody class="tablePostextual">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                                 
                                <!-- Secção do relatorio final-->
                                <div class="tab-pane fade" id="relatorio">
                                    @if($trabalho->descricao=='default.pdf')
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div id="accordion" class="mb-3">
                                                    <div class="card mb-1">
                                                        @can('add_relatorio_final')
                                                            <div class="card-header" id="headingFour">
                                                                <h5 class="m-0">
                                                                    <a class="text-primary" title="Clique aqui para expandir" data-toggle="collapse" href="#collapseRelatorioFinal" aria-expanded="true">
                                                                        <i class="mdi mdi-plus-circle mr-1 text-primary"></i> 
                                                                        ANEXAR O RELATÓRIO FINAL
                                                                    </a>                                                           
                                                                </h5>
                                                            </div>
                                                        @endcan
                                                        <div id="collapseRelatorioFinal" class="collapse hide" aria-labelledby="headingFour" data-parent="#accordion">
                                                            <div class="card-body">
                                                                <form id="formularioRelatorioFinal" method="POST" action="{{ url('registarRelatorioFinal') }}" enctype="multipart/form-data"> 
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-8">
                                                                            <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="id_trabalho" id="id_trabalho">  
                                                                            <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="tema_trabalho" id="tema_trabalho">  
                                                                            <div class="form-group">
                                                                                <label for="genero">Anexo</label><br>
                                                                                <input type="file" required class="form-control" placeholder="Escolha o ficheiro" accept="application/pdf" id="relatorio" name="relatorio">
                                                                                <span style="color:red;font-style:italic">tamanho máximo 4Mb</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group mb-3">
                                                                                <label for="genero">Possui recomendação?</label><br>
                                                                                <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                                    <input type="radio" id="valor" onclick="showRecomendacao(1)" value="1" name="isRecomendacao" checked>
                                                                                    <label for="inlineRadio1"> Sim </label>
                                                                                </div>
                                                                                <div class="radio form-check-inline">
                                                                                    <input type="radio" id="valor" onclick="showRecomendacao(0)" value="0" name="isRecomendacao">
                                                                                    <label for="inlineRadio2"> Não </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="input-recomendacao" class="row">
                                                                        <div class="col-12">
                                                                            <br>
                                                                            <div class="form-group">
                                                                                <textarea name="recomendacao" rows="3" class="form-control" placeholder="Escreva a recomendação caso existir."></textarea>                                                    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <button class="btn btn-sm btn-success waves-effect waves-light" type="submit">Registar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div id="showVisualizarRelatorio" class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Recomendação</label>
                                                    @can('add_relatorio_final')
                                                        <button onclick="editarRelatorio('{{$trabalho->recomendacao}}')" class="btn btn-sm btn-warning float-right btn-rounded" type="submit"><i class='fa fa-pencil-alt mr-2'></i>Editar</button>
                                                    @endcan
                                                    <textarea style="margin-top:5px;background:#f5f6f8" readonly name="recomendacao" rows="3" class="form-control">{{$trabalho->recomendacao}}</textarea>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Form editar relatorio-->
                                        <div style="display:none" id="showEditarRelatorio" class="row">
                                            <div class="col-xl-12">
                                                <div class="card mb-1">
                                                    <div class="card-header bg-warning">
                                                        <h5 class="m-0">
                                                            <a class="text-white" href="#">
                                                                <i class="fa fa-pencil-alt mr-1 text-white"></i>
                                                                EDITAR RELATÓRIO FINAL
                                                            </a>                                                           
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <div style="height:auto" class="card-body">
                                                            <form method="POST" action="{{ url('editarRelatorioFinal') }}" enctype="multipart/form-data"> 
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="id_trabalho" id="id_trabalho">  
                                                                        <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="tema_trabalho" id="tema_trabalho">  
                                                                        <div class="form-group">
                                                                            <label for="genero">Anexo</label><br>
                                                                            <input type="file" required class="form-control" placeholder="Escolha o ficheiro" accept="application/pdf" id="relatorio_edit" name="relatorio_edit">
                                                                            <span style="color:red;font-style:italic">tamanho máximo 4Mb</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group mb-3">
                                                                            <label for="genero">Possui recomendação?</label><br>
                                                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                                <input type="radio" id="valor" onclick="showRecomendacao(1)" value="1" name="isRecomendacao" checked>
                                                                                <label for="inlineRadio1"> Sim </label>
                                                                            </div>
                                                                            <div class="radio form-check-inline">
                                                                                <input type="radio" id="valor" onclick="showRecomendacao(0)" value="0" name="isRecomendacao">
                                                                                <label for="inlineRadio2"> Não </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="input-recomendacao" class="row">
                                                                    <div class="col-12">
                                                                        <br>
                                                                        <div class="form-group">
                                                                            <textarea id="recomendacao_edit" name="recomendacao_edit" rows="3" class="form-control" placeholder="Escreva a recomendação caso existir."></textarea>                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button class="btn btn-warning btn-rounded"><i class="far fa-save"> Actualizar</i></button>                                                           
                                                                    <button onclick="fechaEditarRelatorio()" type="button" class="btn btn-primary btn-rounded"><i class="far fa-window-close"> Fechar</i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif                               
                                    <iframe
                                        src='{{ url("/storage/trabalhos/{$trabalho->descricao}") }}'
                                        type="applicatios/pdf"
                                        height="700px"
                                        width="100%">
                                    </iframe>
                                </div>
                                
                                <!-- Secção da predefesa -->            
                                <div class="tab-pane fade" id="predefesa">
                                    <div id="showFormPredefesa" class="row">
                                        <div class="col-xl-12">
                                            <div id="accordion" class="mb-3">
                                                <div class="card mb-1">
                                                    @can('add_predefesa')
                                                        <div class="card-header" id="headingFour">
                                                            <h5 class="m-0">
                                                                <a class="text-primary" data-toggle="collapse" href="#collapsePredefesa" aria-expanded="true">
                                                                    <i class="mdi mdi-plus-circle mr-1 text-primary"></i> 
                                                                    REGISTAR PRÉ DEFESA
                                                                </a>                                                           
                                                            </h5>
                                                        </div>
                                                    @endcan
                                                    <div id="collapsePredefesa" class="collapse hide" aria-labelledby="headingFour" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <form id="formularioPredefesa" method="POST" action="{{ url('registarPredefesa') }}"> 
                                                                @csrf
                                                                <div class="row">
                                                                    <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">  
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label for="genero">Data</label><br>
                                                                            <input id="datapredefesa" name="datapredefesa" type="date" class="form-control">                                                    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label for="genero">Avaliação</label><br>
                                                                            <select name="avaliacao" id="avaliacao" class="custom-select">
                                                                                <option value="0">Baixa</option>
                                                                                <option value="2">Medíocre</option>
                                                                                <option value="1">Positiva</option>
                                                                            </select>                                                    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label for="genero">Tipo de Pré Defesa</label><br>
                                                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                                <input type="radio" id="inlineRadio1" value="1" name="tipo" checked>
                                                                                <label for="inlineRadio1"> Teórica </label>
                                                                            </div>
                                                                            <div class="radio form-check-inline">
                                                                                <input type="radio" id="inlineRadio2" value="2" name="tipo">
                                                                                <label for="inlineRadio2"> Prática </label>
                                                                            </div>                                               
                                                                        </div>
                                                                    </div>
                                                                </div>                                                            
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group mb-3">
                                                                            <label for="genero">Nota sobre o Trabalho</label><br>
                                                                            <textarea name="nota" type="text" class="form-control" placeholder="Escreva as notas sobre o elemento"></textarea>                                                    
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>                                                           
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>   

                                    <!-- Formulário para editar a predefesa -->                                     
                                    <div id="showEditFormPredefesa" style="display:none" class="row">
                                        <div class="col-12">                                            
                                            <div class="card mb-1">
                                                <div class="card-header bg-warning">
                                                    <h5 class="m-0">
                                                        <a class="text-white" href="#">
                                                            <i class="fa fa-pencil-alt mr-1 text-white"></i> 
                                                            ACTUALIZAR PRÉ DEFESA
                                                        </a>                                                           
                                                    </h5>
                                                </div>
                                                <div>
                                                    <div class="card-body">
                                                        <form id="formularioEditarPredefesa" name="formularioEditarPredefesa" method="POST"> 
                                                            @csrf
                                                            <div class="row">
                                                                <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">                                             
                                                                <input required type="hidden" class="form-control"  name="predefesaid_edit" id="predefesaid_edit">  
                                                                <div class="col-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Data</label><br>
                                                                        <input id="datapredefesa_edit" name="datapredefesa_edit" type="date" class="form-control">                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Avaliação</label><br>
                                                                        <select  name="avaliacao_edit" id="avaliacao_edit" class="custom-select">
                                                                            <option value="0">Negativa</option>
                                                                            <option value="1">Positiva</option>
                                                                            <option value="2">Medíocre</option>
                                                                        </select>                                                    
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Tipo de Pré Defesa</label><br>
                                                                        <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                            <input type="radio" id="inlineRadio1" value="1" name="tipo_edit" checked>
                                                                            <label for="inlineRadio1"> Teórica </label>
                                                                        </div>
                                                                        <div class="radio form-check-inline">
                                                                            <input type="radio" id="inlineRadio2" value="2" name="tipo_edit">
                                                                            <label for="inlineRadio2"> Prática </label>
                                                                        </div>                                               
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group mb-3">
                                                                        <label for="genero">Nota sobre o Trabalho</label><br>
                                                                        <textarea id="nota_edit" name="nota_edit" type="text" class="form-control" placeholder="Escreva as notas sobre o elemento"></textarea>                                                    
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <button class="btn btn-warning btn-rounded"><i class="far fa-save"> Actualizar</i></button>                                                           
                                                            <button type="button" class="fecharFormEditPredefesa btn btn-primary btn-rounded"><i class="far fa-window-close"> Fechar</i></button>        
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Fim do formulário para editar a predefesa -->             

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-box">
                                                <h5 class="table-title"><i class="fas fa-book-reader mr-1"></i>PRÉ DEFESAS</h5><hr>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">                                                        
                                                        <tbody id="predefesaTable">
                                                                   
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Secção do edital --> 
                                <div class="tab-pane fade" id="notainformativa">
                                    <div id="showFormNI" style="display:none" class="row">
                                        <div class="col-xl-12">
                                            <div id="accordion" class="mb-3">
                                                <div class="card mb-1">
                                                    @can('add_edital')
                                                        <div class="card-header" id="headingFour">
                                                            <h5 class="m-0">
                                                                <a class="text-primary" title="Clique aqui para expandir" data-toggle="collapse" href="#collapseNotaInformativa" aria-expanded="true">
                                                                    <i class="mdi mdi-plus-circle mr-1 text-primary"></i> 
                                                                    REGISTAR EDITAL
                                                                </a>                                                           
                                                            </h5>
                                                        </div>
                                                    @endcan
                                                    <div id="collapseNotaInformativa" class="collapse hide" aria-labelledby="headingFour" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <form id="formularioNotaInformativa" method="POST"> 
                                                                @csrf
                                                                <div class="row">
                                                                    <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="id_trabalho" id="id_trabalho">  
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Data</label><br>
                                                                            <input id="datadefesa" name="datadefesa" min='{{date("Y-m-d")}}' type="datetime-local" class="form-control">                                                    
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Local da Defesa</label><br>
                                                                            <input type="text" id="local" name="local" placeholder="Informe o local da realização" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                @php $docentes = App\Model\Pessoa::getDocentes($sessao[0]->id_departamento); @endphp
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Presidente</label><br>
                                                                            <select id="presidente" name="presidente" class="selectpicker" data-live-search="true" data-style="btn-light">
                                                                                <option selected disabled>Escolha o nome</option>
                                                                                @foreach ($docentes as $docente)
                                                                                    <option value="{{$docente->pessoa_id}}">{{$docente->nome}}</option>
                                                                                @endforeach
                                                                            </select>                                      
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Secrétário</label><br>
                                                                            <select id="secretario" name="secretario" class="selectpicker" data-live-search="true" data-style="btn-light">
                                                                                <option selected disabled>Escolha o nome</option>       
                                                                                @foreach ($docentes as $docente)
                                                                                    <option value="{{$docente->pessoa_id}}">{{$docente->nome}}</option>
                                                                                @endforeach
                                                                            </select>                                     
                                                                        </div>
                                                                    </div>
                                                                </div>                                                           
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>1º Vogal</label><br>
                                                                            <select id="vogal_1" name="vogal_1" class="selectpicker" data-live-search="true" data-style="btn-light">
                                                                                <option selected disabled>Escolha o nome</option>
                                                                                @foreach ($docentes as $docente)
                                                                                    <option value="{{$docente->pessoa_id}}">{{$docente->nome}}</option>
                                                                                @endforeach
                                                                            </select>                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>2º Vogal</label><br>
                                                                            @php $vogal2=App\Model\Pessoa::getVogal2($trabalho->id); @endphp
                                                                            <select id="vogal_2" name="vogal_2" class="selectpicker" data-live-search="true" data-style="btn-light">
                                                                                <option value="{{$vogal2->id_docente}}">{{$vogal2->nome}}</option>
                                                                            </select>                                       
                                                                        </div>
                                                                    </div>
                                                                </div>     
                                                                <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>                                                           
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="height:90%" class="card">
                                                <div class="card-body">
                                                    <div id="showNotaVazio" class="row">
                                                        <div id="icone_resultado_proposta" class="col-12">
                                                            <br>
                                                            <img width="100px" heigth="100px" src="{{ url('images/aguardando.png') }}"/>
                                                            <p class="dados-nao-fornecido">NENHUMA NOTA ADICIONADA SOBRE A PROVA PÚBLICA.</p>
                                                        </div>
                                                    </div>
                                                    <table id="notainformativaTable"  class="table table-borderless mb-0">
                                                                
                                                    </table>                
                                                </div>
                                            </div>
                                        </div>
                                    </div>         
                                </div>

                                <!-- Secção da prova publica ou defesa -->                                        
                                <div class="tab-pane fade" id="provapublica">
                                    <div id="showFormPP" style="display:none" class="row">
                                        <div class="col-xl-12">
                                            <div id="accordion" class="mb-3">
                                                <div class="card mb-1">
                                                    @can('add_provapublica')
                                                        <div class="card-header" id="headingFour">
                                                            <h5 class="m-0">
                                                                <a class="text-primary" title="Clique aqui para expandir" data-toggle="collapse" href="#collapseFour" aria-expanded="true">
                                                                    <i class="mdi mdi-plus-circle mr-1 text-primary"></i> 
                                                                    REGISTAR PROVA PÚBLICA
                                                                </a>                                                           
                                                            </h5>
                                                        </div>
                                                    @endcan
                                                    <div id="collapseFour" class="collapse hide" aria-labelledby="headingFour" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <form id="formularioProvaPublica" method="POST" action="{{ url('registarProvapublicaaaa') }}"> 
                                                                @csrf
                                                                <?php 
                                                                    $ni= App\Model\NotaInformativa::getNotaInformativa($trabalho->id);                                                 
                                                                ?>
                                                                <div class="row">
                                                                    <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="id_trabalho" id="id_trabalho">  
                                                                    <input required type="hidden" @if(is_object($ni))value="{{$ni->id}}" @endif class="form-control"  name="id_nota" id="id_nota">  
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label>Data</label><br>
                                                                            <input @if(is_object($ni))value="{{$ni->created_at}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="data_defesa" readonly type="text" class="form-control">                  
                                                                                                                          
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label>Nota da Defesa</label><br>
                                                                            <input type="number" id="nota_defesa" min="10" max="20" name="nota_defesa" placeholder="Informe a nota da defesa" class="form-control">                                                  
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="form-group mb-3">
                                                                            <label>Local da Defesa</label><br>
                                                                            <input @if(is_object($ni))value="{{$ni->local}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="local_defesa" readonly type="text" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Presidente</label><br>
                                                                            <input  @if(is_object($ni)) value="{{$ni->presidente}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="presidente_defesa" readonly type="text" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>Secrétário</label><br>
                                                                            <input @if(is_object($ni)) value="{{$ni->secretario}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="secretario_defesa" readonly type="text" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                </div>                                                           
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>1º Vogal</label><br>
                                                                            <input @if(is_object($ni)) value="{{$ni->vogal_1}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="vogal_1_defesa" readonly type="text" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group mb-3">
                                                                            <label>2º Vogal</label><br>
                                                                            <input @if(is_object($ni)) value="{{$ni->vogal_2}}" style="background:#a3ffd4" @else id="input-provapublica" @endif name="vogal_2_defesa" readonly type="text" class="form-control">                                       
                                                                        </div>
                                                                    </div>
                                                                </div>                                                           
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group mb-3">
                                                                            <label>Anotações</label><br>
                                                                            <textarea name="anotacao" type="text" rows="5" class="form-control" placeholder="Escreva as anotações sobre a prova pública"></textarea>                                                    
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>                                                           
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="height:95%" class="card">
                                                <div class="card-body">
                                                    <div id="showPPVazio" class="row">
                                                        <div id="icone_resultado_proposta" class="col-12">
                                                            <br>
                                                            <img width="100px" heigth="100px" src="{{ url('images/aguardando.png') }}"/>
                                                            <p class="dados-nao-fornecido">NENHUMA PROVA PÚBLICA REALIZADA AINDA.</p>
                                                        </div>
                                                    </div>
                                                    <table id="provapublicaTable" class="table table-borderless mb-0">
                                                                        
                                                    </table>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <br>
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
    function carregarDataTable(){
        var trabalho_id = $('#trabalho_id').val(); //id da sugestão selecionada
        //var sugestao_estado = $('#sugestao_estado').val(); //id da sugestão selecionada
        $.ajax({
            url: "{{ url('verEnvolventesTrabalho') }}/"+trabalho_id,
            success:function(data){
                $('#dataTable').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados envolventes");
			}
        })
    }
    carregarDataTable();

    //Função para chamar o input de adicionar anexo ficheiro do elemento
    function mudaAnexoElemento(anexo){
        if(anexo==1){
            document.getElementById("showAnexo1").style.display = 'block';
            document.getElementById("showBtnAdicionar1").style.display = 'none';
            document.getElementById("showBtnCancelar1").style.display = 'block';
        }
        if(anexo==2){
            document.getElementById("showAnexo2").style.display = 'block';
            document.getElementById("showBtnAdicionar2").style.display = 'none';
            document.getElementById("showBtnCancelar2").style.display = 'block';
        }
        if(anexo==3){
            document.getElementById("showAnexo3").style.display = 'block';
            document.getElementById("showBtnAdicionar3").style.display = 'none';
            document.getElementById("showBtnCancelar3").style.display = 'block';
        }
    };

    //Função que permite fechar a input para anexo do ficheiro do elemento
    function fecharAnexo(anexo){
        if(anexo==1){
            document.getElementById("showAnexo1").style.display = 'none';
            document.getElementById("showBtnAdicionar1").style.display = 'block';
            document.getElementById("showBtnCancelar1").style.display = 'none';
        }
        if(anexo==2){
            document.getElementById("showAnexo2").style.display = 'none';
            document.getElementById("showBtnAdicionar2").style.display = 'block';
            document.getElementById("showBtnCancelar2").style.display = 'none';
        }
        if(anexo==3){
            document.getElementById("showAnexo3").style.display = 'none';
            document.getElementById("showBtnAdicionar3").style.display = 'block';
            document.getElementById("showBtnCancelar3").style.display = 'none';
        }
    };

    //Mostrar e ocultar a parte da avaliação de um elemento ou item
    function showAvaliacaoElemento(op,id_item){
        if(op==1){
            document.getElementById("showFormAvaliar1").style.display = 'block';
            document.getElementById("id_item").value = id_item;
        }else if(op==2){
            document.getElementById("showFormAvaliar2").style.display = 'block';
            document.getElementById("id_item2").value = id_item;
        }else if(op==3){
            document.getElementById("showFormAvaliar3").style.display = 'block';
            document.getElementById("id_item3").value = id_item;
        }else{
            document.getElementById("showFormAvaliar1").style.display = 'none';
            document.getElementById("showFormAvaliar2").style.display = 'none';
            document.getElementById("showFormAvaliar3").style.display = 'none';
        }
    }

    //Mostrar os dados do item pretextual
    function carregarTablePretextual(){
        var id_trabalho = $('#trabalho_id').val();
        var item_tipo=1;
        $.ajax({
            url: "{{ url('pegaElemento') }}/"+id_trabalho+"/"+item_tipo,
            success:function(data){
                $('.tablePretextual').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados pretextual");
			}
        })
    };
    carregarTablePretextual();
    
    //Mostrar os dados do item textual
    function carregarTableTextual(){
        var id_trabalho = $('#trabalho_id').val();
        var item_tipo=2;
        $.ajax({
            url: "{{ url('pegaElemento') }}/"+id_trabalho+"/"+item_tipo,
            success:function(data){
                $('.tableTextual').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados textual");
			}
        })
    };
    carregarTableTextual();
    
    //Mostrar os dados do item Pós textual
    function carregarTablePostextual(){
        var id_trabalho = $('#trabalho_id').val();
        var item_tipo=3;
        $.ajax({
            url: "{{ url('pegaElemento') }}/"+id_trabalho+"/"+item_tipo,
            success:function(data){
                $('.tablePostextual').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados postextual");
			}
        })
    };
    carregarTablePostextual();

    //Mudar a cor do item-elemento aprovado ou rejeitado
    function mudarCorCabecalho(){
        var id_trabalho = $('#trabalho_id').val();
        $.ajax({
            url: "{{ url('pegaElementosAvaliacao') }}/"+id_trabalho,
            success:function(data){

                if(data.prTextual==1){
                    document.getElementById("headingOne").style.background = '#91FBBE';
                } else if(data.prTextual==0){ 
                    document.getElementById("headingOne").style.background = '#FDB5AF';
                }

                if(data.textual==1){
                    document.getElementById("headingTwo").style.background = '#91FBBE';
                } else if(data.textual==0){ 
                    document.getElementById("headingTwo").style.background = '#FDB5AF';
                }

                if(data.psTextual==1){
                    document.getElementById("headingThree").style.background = '#91FBBE';
                } else if(data.psTextual==0){ 
                    document.getElementById("headingThree").style.background = '#FDB5AF';
                }
            },
            error: function(e)
			{
				alert("erro ao carregar dados cabeca");
			}
        })        
    }
    mudarCorCabecalho();

    //Registar elemento ou item
    $('.formElemento').submit(function(e){  
        e.preventDefault();
        var request = new FormData(this);
        Swal.fire({
			  title: 'Ao adicionar novo elemento, irá substituir o ficheiro existente caso existir. Deseja continuar? ',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'OK',
              cancelButtonText: 'Cancelar'
		}).then((result) => {
            if (result.value) {
                $.ajax({
                    url:"{{ url('registarItem') }}",
                    type: "POST",
                    data: request,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data){                    
                        $('.formElemento')[0].reset();
                        carregarTablePretextual();
                        carregarTableTextual();
                        carregarTablePostextual();
                        fecharAnexo(data);
                        mudarCorCabecalho();
                        if(data == 5){
                            Swal.fire({
                                text: 'Este elemento já se encontra aprovado.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            });
                        }else if(data == 4){
                            Swal.fire({
                                text: 'O elemento anterior precisa ser avaliado primeiro.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            });
                        }else{
                            Swal.fire({
                                text: 'Elemento registado com sucesso.',
                                icon: 'success',
                                confirmButtonText: 'Fechar'
                            });
                        }
                    },
                    error: function(e){
                        $('.formElemento')[0].reset();
                        Swal.fire({
                            text: 'Ocorreu um erro ao registar o item.',
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }
                });  
            }          
		});
    });

    //Disable future date
    var today = new Date().toISOString().split('T')[0];
	document.getElementsByName("datapredefesa")[0].setAttribute('max', today);
    
    var today1 = new Date().toISOString().split('T')[0];
	document.getElementsByName("datapredefesa_edit")[0].setAttribute('max', today1);

    //Mostar a input da recomendação ao cadastrar relatorio
    function showRecomendacao(value){
        if(value==1){          
            document.getElementById("input-recomendacao").style.display = 'block';
        }else if(value==0){
            document.getElementById("input-recomendacao").style.display = 'none';
        }
    }

    //Mostar o formulario para editar o relatório final
    function editarRelatorio(recomendacao){
        document.getElementById("showVisualizarRelatorio").style.display = 'none';
        document.getElementById("showEditarRelatorio").style.display = 'block';  

        
        $('#recomendacao_edit').val(recomendacao);    
    }
    
    //Fechar o formulario para editar o relatório final
    function fechaEditarRelatorio(){
        document.getElementById("showVisualizarRelatorio").style.display = 'block';
        document.getElementById("showEditarRelatorio").style.display = 'none';      
    }

    $("#formularioPredefesa").validate({
        rules: {					
            datapredefesa: {
                required: true
            },
            nota: {
                required: true,
                minlength:5
            }
        },
        messages: {					
            datapredefesa: {
                required: "A data deve ser fornecida."
            },
            nota: {
                required: "A recomendação deve ser fornecida.",
                minlength: "O tamanho do texto fornecido é inferior.",
            }               
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioSalvar,e){  			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('registarPredefesa') }}",
                method: "POST",
                data: $("#formularioPredefesa").serialize(),
                success:function(data){
                    if(data == "Sucesso"){
                        $('#formularioPredefesa')[0].reset();
                        carregarPredefesas();
                        location.reload();
                        Swal.fire({
                            text: "Pré defesa registada com sucesso.",
                            icon: 'success',
                            confirmButtonText: 'Fechar'
                        })
                    }else if(data == 2){
                        Swal.fire({
                            text: "Já foi registada uma pré defesa para este trabalho com esta data.",
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }         
                },
                error: function(response){
					
                }
            });
        }            
    });

    $("#formularioEditarPredefesa").validate({
        rules: {					
            datapredefesa_edit: {
                required: true
            },
            nota_edit: {
                required: true,
                minlength:5
            }
        },
        messages: {					
            datapredefesa_edit: {
                required: "A data deve ser fornecida."
            },
            nota_edit: {
                required: "A recomendação deve ser fornecida.",
                minlength: "O tamanho do texto fornecido é inferior.",
            }               
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioSalvar,e){  			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('editarPredefesa') }}",
                method: "POST",
                data: $("#formularioEditarPredefesa").serialize(),
                success:function(data){
                    if(data == "Sucesso"){
                        carregarPredefesas();
                        $('.fecharFormEditPredefesa').click();
                        Swal.fire({
                            text: "Pré defesa actualizada com sucesso.",
                            icon: 'success',
                            timer: 1500,
                            confirmButtonText: 'Fechar'
                        })
                    }else if(data == 2){
                        Swal.fire({
                            text: "Já foi registada uma pré defesa para este trabalho na data de hoje.",
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }         
                },
                error: function(response){
					
                }
            });
        }            
    });

    function carregarPredefesas(){
        var trabalho_id = $('#trabalho_id').val(); 
        $.ajax({
            url: "{{ url('listarPredefesaTrabalho') }}/"+trabalho_id,
            success:function(data){
                $('#predefesaTable').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados predefe");
			}
        })
    }
    carregarPredefesas();

    //Chamar o formulario para editar predefesa
    $(document).on('click','.showEditPredefesa',function(e){
        window.scrollTo(0,0);
        e.preventDefault();
        var id = $(this).attr('id');        
        var datapredefesa = $(this).attr('datapredefesa');
        var tipo = $(this).attr('tipo');
        var avaliacao = $(this).attr('avaliacao');
        var nota = $(this).attr('nota');

        document.getElementById("showFormPredefesa").style.display = 'none';
        document.getElementById("showEditFormPredefesa").style.display = 'block';
       
        $('#predefesaid_edit').val(id);
        $('#avaliacao_edit').val(avaliacao);
        $('#nota_edit').val(nota);
        $('#datapredefesa_edit').val(datapredefesa);
     
        switch(tipo){
            case 'Teórica': document.formularioEditarPredefesa.tipo_edit[0].checked=true;break;
            case 'Prática': document.formularioEditarPredefesa.tipo_edit[1].checked=true;break;
        }
        
        switch(avaliacao){
            case 'Negativa': document.getElementById("avaliacao_edit").value = 0;break;
            case 'Positiva': document.getElementById("avaliacao_edit").value = 1;break;
            case 'Medíocre': document.getElementById("avaliacao_edit").value = 2;break;
        }
    });

    //Fechar o formulario aberto na edição da predefesa
    $(document).on('click','.fecharFormEditPredefesa',function(e){
        document.getElementById("showFormPredefesa").style.display = 'block';
        document.getElementById("showEditFormPredefesa").style.display = 'none';
    });
    
    //Eliminar uma predefesa
    $(document).on('click','.eliminarPredefesa',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar a pré defesa?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('eliminarPredefesa') }}/"+id,
                        type: "GET",
                        success: function(data){
                            if(data==1){
                                carregarPredefesas();
                                Swal.fire({
                                    text: 'Eliminado com Sucesso.',
                                    icon: 'success',
                                    timer: 1500
                                })
                            }else{
                                Swal.fire({
                                    text: 'Ocorreu um erro ao eliminar a pré defesa.',
                                    icon: 'error',
                                    confirmButtonText: 'Fechar'
                                })
                            }
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar a pré defesa.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });

    //Nota informativa
    function carregarNotaInformativa(){
        var trabalho_id = $('#trabalho_id').val(); 
        $.ajax({
            url: "{{ url('listarNotaInformativa') }}/"+trabalho_id,
            success:function(data){
                $('#notainformativaTable').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados NI: ");
			}
        })
    }
    carregarNotaInformativa();

    //Mostrar a parte do registo da nota informativa
    function showFormNotaInformativa(){
        var id_trabalho = $('#trabalho_id').val();
        $.ajax({
            url: "{{ url('checkTrabalhoNotaInformativa') }}/"+id_trabalho,
            success:function(data){
                if(data==1){
                    document.getElementById("showFormNI").style.display = 'none';
                    document.getElementById("showNotaVazio").style.display = 'none';
                }else{ 
                    document.getElementById("showFormNI").style.display = 'block';
                    document.getElementById("showNotaVazio").style.display = 'block';
                    document.getElementById("notainformativaTable").style.display = 'none';
                }
            },
            error: function(e)
			{
				showFormNotaInformativa();
			}
        })        
    }
    showFormNotaInformativa();

    $("#formularioNotaInformativa").validate({
        rules: {					
            datadefesa: {
                required: true
            },
            local: {
                required: true,
            },
            presidente: {
                required: true,  
            },
            secretario: {
                required: true,
            },
            vogal_1: {
                required: true,    
            },
            vogal_2: {
                required: true,    
            },
        },
        messages: {					
            datadefesa: {
                required: "A data deve ser fornecida."
            },           
            local: {
                required: "O local deve ser fornecida."               
            },               
            presidente: {
                required: "O nome do presidente deve ser fornecida.",        
            },               
            secretario: {
                required: "O nome do secretário deve ser fornecido.",                  
            },               
            vogal_1: {
                required: "O nome do 1º vogal deve ser fornecido.",                   
            },               
            vogal_2: {
                required: "O nome do 2º vogal deve ser fornecida.",                   
            }                
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioNotaInformativa,e){  			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('registarNotaInformativa') }}",
                method: "POST",
                data: $("#formularioNotaInformativa").serialize(),
                success:function(data){
                    if(data == 0){
                        Swal.fire({
                            text: "Deve realizar primeiro a pré-defesa.",
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }else if(data == 1){
                        $('#formularioNotaInformativa')[0].reset();
                        carregarNotaInformativa();
                        location.reload();                        
                        Swal.fire({
                            text: "Nota informativa registada com sucesso..",
                            icon: 'success',
                            timer: 1500,
                            confirmButtonText: 'Fechar'
                        })
                    }else{
                        Swal.fire({
                            text: "Houve erro ao registar a nota informativa.",
                            icon: 'error',
                            timer: 1500,
                            confirmButtonText: 'Fechar'
                        })
                    }         
                },
                error: function(response){
					
                }
            });
        }            
    });

    //Eliminar nota informativa
    $(document).on('click','.eliminarNotaInformativa',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar a nota informativa?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id_Nota = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('eliminarNotaInformativa') }}/"+id_Nota,
                        type: "GET",
                        success: function(data){
                            if(data==1){
                                carregarNotaInformativa();
                                showFormNotaInformativa();
                                Swal.fire({
                                    text: 'Eliminado com Sucesso.',
                                    icon: 'success',
                                    timer: 1800
                                })
                                //location.reload();
                            }else{
                                Swal.fire({
                                    text: 'Ocorreu um erro ao eliminar.',
                                    icon: 'error',
                                    confirmButtonText: 'Fechar'
                                })
                            }
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });


    //Prova Pública
    function carregarProvapublica(){
        var trabalho_id = $('#trabalho_id').val(); 
        $.ajax({
            url: "{{ url('listarProvapublica') }}/"+trabalho_id,
            success:function(data){
                $('#provapublicaTable').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados PP");
			}
        })
    }
    carregarProvapublica();

    //Mostrar a parte do registo da nota informativa
    function showFormProvaPublica(){
        var id_trabalho = $('#trabalho_id').val();
        $.ajax({
            url: "{{ url('checkTrabalhoProvaPublica') }}/"+id_trabalho,
            success:function(data){
                if(data==1){
                    document.getElementById("showFormPP").style.display = 'none';
                    document.getElementById("showPPVazio").style.display = 'none';
                }else{ 
                    document.getElementById("showFormPP").style.display = 'block';
                    document.getElementById("showPPVazio").style.display = 'block';                    
                    document.getElementById("provapublicaTable").style.display = 'none';
                }
            },
            error: function(e)
			{
				alert("erro ao carregar dados SHOWPP");
			}
        })        
    }
    showFormProvaPublica();

    $("#formularioProvaPublica").validate({
        rules: {					
            data_defesa: {
                required: true
            },
            nota_defesa: {
                required: true,
                max:20,
                min:10
            },
            local_defesa: {
                required: true,
            },
            presidente_defesa: {
                required: true,
                pattern: /^[a-zA-ZáÁàÀãÃçÇéÉèÈíÍìÌñÑõÕóÓúÚâêôÂÊÔ\s]+$/      
            },
            secretario_defesa: {
                required: true,
                pattern: /^[a-zA-ZáÁàÀãÃçÇéÉèÈíÍìÌñÑõÕóÓúÚâêôÂÊÔ\s]+$/     
            },
            vogal_1_defesa: {
                required: true,
                pattern: /^[a-zA-ZáÁàÀãÃçÇéÉèÈíÍìÌñÑõÕóÓúÚâêôÂÊÔ\s]+$/     
            },
            vogal_2_defesa: {
                required: true,
                pattern: /^[a-zA-ZáÁàÀãÃçÇéÉèÈíÍìÌñÑõÕóÓúÚâêôÂÊÔ\s]+$/     
            },
        },
        messages: {					
            data_defesa: {
                required: "A data deve ser fornecida."
            },
            nota_defesa: {
                required: "A nota deve ser fornecida.",
                max: "O valor máximo deve ser 20 valores.",               
                min: "O valor mínimo deve ser 0 valores."               
            },               
            local_defesa: {
                required: "O local deve ser fornecida."               
            },               
            presidente_defesa: {
                required: "O nome do presidente deve ser fornecida.",
                pattern: "Informe um nome contendo apenas letras alfabéticas"         
            },               
            secretario_defesa: {
                required: "O nome do secretário deve ser fornecido.",
                pattern: "Informe um nome contendo apenas letras alfabéticas"                    
            },               
            vogal_1_defesa: {
                required: "O nome do 1º vogal deve ser fornecido.",
                pattern: "Informe um nome contendo apenas letras alfabéticas"                    
            },               
            vogal_2_defesa: {
                required: "O nome do 2º vogal deve ser fornecida.",
                pattern: "Informe um nome contendo apenas letras alfabéticas"                    
            }       
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioSalvar,e){  			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('registarProvapublica') }}",
                method: "POST",
                data: $("#formularioProvaPublica").serialize(),
                success:function(data){
                    if(data == 1){
                        $('#formularioProvaPublica')[0].reset();
                        //carregarProvapublica();
                        //showFormProvaPublica();
                        location.reload();
                        Swal.fire({
                            text: "Prova pública registada com sucesso.",
                            icon: 'success',
                            timer:9500,
                            confirmButtonText: 'Fechar'
                        })
                    }       
                },
                error: function(response){
                    Swal.fire({
                        text: "Houve um erro ao registar a prova pública, verifique os dados e tente novamente.",
                        icon: 'error',
                        timer:1500,
                        confirmButtonText: 'Fechar'
                    })
                }
            });
        }            
    });  

    //Eliminar prova publica
    $(document).on('click','.eliminarProvaPublica',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar a prova pública?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id_prova = $(this).attr('id_prova');
                    $.ajax({
                        url: "{{ url('eliminarProvaPublica') }}/"+id_prova,
                        type: "GET",
                        success: function(data){
                            if(data==1){
                                carregarProvapublica();
                                showFormProvaPublica();
                                
                                Swal.fire({
                                    text: 'Eliminado com Sucesso.',
                                    icon: 'success',
                                    timer: 1500
                                })
                            }else{
                                Swal.fire({
                                    text: 'Ocorreu um erro ao eliminar.',
                                    icon: 'error',
                                    confirmButtonText: 'Fechar'
                                })
                            }
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });
  
</script>
@stop
