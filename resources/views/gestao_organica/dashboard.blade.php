
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
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->     
        
    
        <!--Fim do conteudo-->
    </div> 
</div>
@stop