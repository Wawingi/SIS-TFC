@extends('layouts.inicio')
@section('content')
<?php 
    //sessão dos dados do utilizador logado
    $sessao=session('dados_logado'); 
?>
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
                            <li class="breadcrumb-item active">Listar utilizadores</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <!--listagem do funcionario-->   
        <br><br>
        <?php if($sessao[0]->tipo==1){ ?>    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <a href='{{ url("registarUtilizador")}}' class="btn btn-outline-secondary waves-effect waves-light" data-overlayColor="#38414a"><i class="fas fa-user-plus mr-1"></i> Registar Utilizador</a></h4><br>
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR FUNCIONÁRIOS</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR CHEFES DE DEPARTAMENTO</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Listagem de funcionarios-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table id="paginationFuncionario" class="table table-centered mb-0">
                                                    <thead class="font-13 bg-light text-muted">
                                                        <tr>
                                                            <th class="font-weight-medium"></th>
                                                            <th class="font-weight-medium">Nome Completo</th>
                                                            <th class="font-weight-medium">BI</th>
                                                            <th class="font-weight-medium">Função</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dados as $dado)
                                                        <tr>
                                                            <td >
                                                                <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                            </td>
                                                            <td><a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}' class="btn btn-outline-secondary btn-sm waves-effect waves-light">{{$dado->nome}}</a></td>
                                                            <td>{{$dado->bi}}</td>
                                                            <td>{{$dado->funcao}}</td>
                                                        </tr>
                                                        @endforeach   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                    <!-- Listagem de chefes de departamento-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table id="paginationChefe" class="table table-centered mb-0">
                                                    <thead class="font-13 bg-light text-muted">
                                                        <tr>
                                                            <th class="font-weight-medium"></th>
                                                            <th class="font-weight-medium">Nome Completo</th>
                                                            <th class="font-weight-medium">BI</th>
                                                            <th class="font-weight-medium">Função</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dadosChefeDepartamento as $dado)
                                                        <tr>
                                                            <td >
                                                                <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                            </td>
                                                            <td><a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)."/".base64_encode($dado->tipo)) }}' class="btn btn-outline-secondary btn-sm waves-effect waves-light">{{$dado->nome}}</a></td>
                                                            <td>{{$dado->bi}}</td>
                                                            <td>{{$dado->departamento}}</td>
                                                        </tr>
                                                        @endforeach   
                                                    </tbody>
                                                </table>
                                            </div>                                                
                                        </div>                       
                                    </div>
                                    <div class="clearfix"></div>
                                </div> 
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        <?php }else{ ?> 
        <!--Fim do conteudo-->
        <!--Inicio do conteudo docente e estudante-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <a href='{{ url("registarUtilizador")}}' class="btn btn-outline-secondary waves-effect waves-light" data-overlayColor="#38414a"><i class="fas fa-user-plus mr-1"></i> Registar Utilizador</a></h4><br>
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR DOCENTES</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR ESTUDANTES</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Listagem de docentes-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table id="paginationChefe" class="table table-centered mb-0">
                                                    <thead class="font-13 bg-light text-muted">
                                                        <tr>
                                                            <th class="font-weight-medium"></th>
                                                            <th class="font-weight-medium">Nome Completo</th>
                                                            <th class="font-weight-medium">BI</th>
                                                            <th class="font-weight-medium">Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dados as $dado)
                                                        <tr>
                                                            <td >
                                                                <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                            </td>
                                                            <td><a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}' class="btn btn-outline-secondary btn-sm waves-effect waves-light">{{$dado->nome}}</a></td>
                                                            <td>{{$dado->bi}}</td>
                                                            <td>{{$dado->email}}</td>
                                                        </tr>
                                                        @endforeach   
                                                    </tbody>
                                                </table>
                                            </div>     
                                        </div> 
                                    </div>
                                    <!-- Listagem de estudantes-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table id="paginationEstudante" class="table table-centered mb-0">
                                                    <thead class="font-13 bg-light text-muted">
                                                        <tr>
                                                            <th class="font-weight-medium"></th>
                                                            <th class="font-weight-medium">Nome Completo</th>
                                                            <th class="font-weight-medium">BI</th>
                                                            <th class="font-weight-medium">Curso</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($dadosEstudante as $dado)
                                                        <tr>
                                                            <td >
                                                                <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                            </td>
                                                            <td><a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)."/".base64_encode($dado->tipo)) }}' class="btn btn-outline-secondary btn-sm waves-effect waves-light">{{$dado->nome}}</a></td>
                                                            <td>{{$dado->bi}}</td>
                                                            <td>{{$dado->email}}</td>
                                                        </tr>
                                                        @endforeach   
                                                    </tbody>
                                                </table>
                                            </div>     
                                        </div>                
                                    </div>

                                    <div class="clearfix"></div>
                                </div> <!-- tab-content -->
                            </div> <!-- end #btnwizard-->
                        </div> <!-- end card-body -->
                    </div>
                </div>
            </div>
        <?php } ?>     
    </div> 
</div>

<script>
	$(document).ready(function () {
		//Pagination full Numbers
		$('#paginationFuncionario').DataTable({
			"pagingType": "full_numbers"
		});
        $('#paginationChefe').DataTable({
			"pagingType": "full_numbers"
		});
        $('#paginationEstudante').DataTable({
			"pagingType": "full_numbers"
		});
        
	});
</script>
@stop