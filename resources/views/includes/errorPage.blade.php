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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{$menu}}</a></li>
                            <li class="breadcrumb-item active">{{$pagina}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{$pagina}}</h4>
                </div>
            </div>
        </div>
        <br><br>
        <div class="card-box">
            <div class="row">
                <div id="icone_resultado_proposta" class="col-12">
                    <br>
                    <img width="150px" heigth="150px" src="{{ url('images/rejeitar.png') }}"/>
                    <p class="proposta-rejeitada">{{$info}}</p>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@stop