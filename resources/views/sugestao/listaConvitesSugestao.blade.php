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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Propostas & Sugestões</a></li>
                            <li class="breadcrumb-item active">Solicitações Recebidas</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Solicitações Recebidas</h4>
                </div>
            </div>
        </div>
        <br>

        <div class="alert alert-warning" role="alert">
            <i class="mdi mdi-alert-outline mr-2"></i><strong>Foste selecionado a fazer parte deste(s) grupo(s) para desenvolver o tema abaixo</strong>
        </div>

        <!-- Inclusão da Modal -->
        @include('includes.sugestao.modalDescricaoSugestao')

        @foreach($convites as $convite)
        <div class="card-box">
            <div class="row">
                <div class="col-lg-10">
                    <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                        <a title="Clique aqui para ver a sugestão" href='{{ url("verSugestao/".base64_encode($convite->id)."/".base64_encode(1)) }}' style="color:#6c757d">
                            <li style="height:120px" id="task1" class="task-medium sairGrupo">
                                <br>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label"> Tema</p>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label">: {{$convite->tema}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label"> Área de aplicação</p>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label">: {{$convite->area}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label"> Orientador</p>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label">: {{$convite->docente}}</label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </a>
                    </ul>
                </div>

                <div class="col-lg-2 card-box ">
                    <a style="margin-left:20%" class="pegar" descricao="{{$convite->descricao}}" href="#" data-backdrop="static" data-keyboard="false">
                        <img class="sairGrupo" width="70px" heigth="70px" title="Clique aqui para ver o relatório" src="{{ url('images/file.png') }}"/>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var descricao = $(this).attr('descricao');
        let source = "{{ url('storage/propostas') }}/"+descricao;
        $('.verDescricao').modal('show');
        $('#filePDF').attr('src', source);
    });
</script>
@stop
