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
                            <li class="breadcrumb-item active">Pesquisar Departamento</li>
                        </ol>
                    </div>
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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong>
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
                <div class="row">
                    <div class="col-lg-12">  
                        <div style="background-color:white;border:solid 1px #3bafda" class="modal-content">
                            <div style="background-color:#3bafda" class="modal-header">
                                <h4 style="color:white" class="modal-title" id="myLargeModalLabel"><i class='fas fa-search'></i>   Pesquisar Departamento </h4>
                            </div>
                            <form method="post" action="{{ url('pesquisarDepartamento') }}"> 
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Departamento</label>
                                        <input required type="text" class="form-control" id="nome" name="nome" placeholder="Informe o departamento">
                                    </div>
                                    <input reuired type="hidden" class="form-control" id="id_curso"  name="id_curso">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i class="mdi mdi-file-find mr-1"></i>Pesquisar</button>
                                </div>
                            </form> 
                        </div>     
                    </div>
                </div>  
            </div>
        </div>         
    </div> 
</div>
   
@stop