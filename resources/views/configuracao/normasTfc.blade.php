<?php 
    //sessão dos dados do utilizador logado
    //$sessao=session('dados_logado'); 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Configurações</a></li>
                            <li class="breadcrumb-item active">Normas TFC</li>
                        </ol>
                    </div>                   
                    <h4 class="page-title">Normas de TFC</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->          
        <div class="card-box">
            <div class="row">                            
                <div class="col-12">
                    <iframe
                        src='{{ url("/pdf/normasTFC.pdf") }}'
                        type="applicatios/pdf"
                        height="700px"
                        width="100%">
                    </iframe>
                </div>
            </div>
        </div> 
    </div> 
</div>  
@stop