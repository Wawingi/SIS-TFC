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

        <!--Inicio do conteudo-->
        <br><br>
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-12">  
                            <div class="row">
                                <div class="col-lg-12">
                                        @foreach($dados as $departamento)
                                        <a id="pesquisadoDPTO" href='{{ url("verDepartamento/".base64_encode($departamento->id)) }}'>
                                            <div id="card-view" class="modal-content">
                                                <div style="background-color:#f5f6f8" class="modal-header">
                                                    <h4 style="color:#3bafda;text-align:center" class="modal-title"><i class='remixicon-government-line'></i> {{$departamento->nome}}</h4>
                                                </div>    
                                                
                                                <div style="padding-bottom:0px" class="card-body">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p id="corLinkPesquisa" class="col-md-5 col-form-label" for="name2"> Chefe do Departamento</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label id="corLinkPesquisa" class="col-md-7 col-form-label" for="name2">: {{$departamento->chefe_departamento}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p id="corLinkPesquisa" class="col-md-5 col-form-label" for="name2"> Email</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label id="corLinkPesquisa" class="col-md-7 col-form-label" for="name2">: {{$departamento->email}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p id="corLinkPesquisa" class="col-md-5 col-form-label" for="name2"> Telefone</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label id="corLinkPesquisa" class="col-md-7 col-form-label" for="name2">: {{$departamento->telefone}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p id="corLinkPesquisa" class="col-md-5 col-form-label" for="name2"> Tipo</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label id="corLinkPesquisa" class="col-md-7 col-form-label" for="name2">: <?php if($departamento->tipo == 1) { echo 'Departamento Administrativo';} else{ echo 'Departamento Estudantil';} ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </a>
                                        <br>
                                         @endforeach        
                                </div>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        </div>         
    </div> 
</div>
   
@stop