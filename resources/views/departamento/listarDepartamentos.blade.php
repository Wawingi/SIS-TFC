<?php 
    //sessão dos dados do utilizador logado
    $sessao=session('dados_logado'); 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Departamentos</a></li>
                            <li class="breadcrumb-item active">Listar Departamentos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
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
        <br><br>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-4">  
                                <a href="#custom-modal" class="btn btn-primary waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-plus-circle mr-1"></i> Adicionar Departamento</a>     
                            </div><!-- end col-->
                        </div> <!-- end row -->
                    </div> <!-- end card-box -->
                </div><!-- end col-->
            </div>
            
            <!-- Inclusão da Modal -->
            @include('includes.modalDepartamento')

            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table class="table mb-0">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Chefe do Departamento</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($departamentos as $departamento)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$departamento->nome}}</td>
                                    <td>{{$departamento->chefe_departamento}}</td>
                                    <td>{{$departamento->email}}</td>
                                    <td>{{$departamento->telefone}}</td>
                                    <td class="float-right">
                                        <a href="#" class="btn btn-primary btn-sm"><i class='fa fa-eye'></i></a>
                                        <a href="#" class="edit-modal btn btn-warning btn-sm"><i class='fa fa-pencil-alt'></i></a>
                                        <a href="#" class="delete-modal btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
                                    </td>
                                </tr>
                            @endforeach 
                            </tbody>
                        </table>
                        <hr>
                        {{ $departamentos->links() }}
                        </div>
                    </div> <!-- end card-box-->
                </div> <!-- end col -->
            </div>
    </div> 
</div>

@stop