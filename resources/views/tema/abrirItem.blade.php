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
                            <li class="breadcrumb-item active">Abrir Item</li>
                        </ol>
                    </div>
                    <h4 class="page-title">
                        @if($ficheiro->titulo==1)
                            Ver Elemento Pré-Textual
                        @elseif($ficheiro->titulo==2)
                            Ver Elemento Textual
                        @elseif($ficheiro->titulo==3)
                            Ver Elemento Pós-Textual
                        @endif
                    </h4>
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
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <iframe
                        src='{{ url("/storage/propostas/itens/{$ficheiro->anexo}") }}'
                        type="applicatios/pdf"
                        height="700px"
                        width="100%">
                    </iframe>                    
                </div>
            </div>
        </div>
        <br>
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
</script>
@stop
