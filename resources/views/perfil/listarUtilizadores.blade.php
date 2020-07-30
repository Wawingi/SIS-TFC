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
                    <h4 class="page-title">Listar utilizadores</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <!--listagem do funcionario-->   
        <br><br>
        <?php if($sessao[0]->tipo==1){ ?>    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card-box">
                        <!-- Listagem de funcionarios-->
                        <table id="paginationFuncionario" class="table table-bordered">
                            <thead id="cabecatabela">
                                <tr>
                                    <th class="font-weight-medium"></th>
                                    <th class="font-weight-medium float-center">Nome Completo</th>
                                    <th class="font-weight-medium">Documento Nº</th>
                                    <th class="font-weight-medium">Departamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dados as $dado)
                                <tr title="Clique aqui para ver utilizador" class="clickable-row tabelaClicked" data-href='{{ url("verperfilUtilizador/".base64_encode($dado->id)."/".base64_encode($dado->tipo)) }}'>
                                    <td >
                                        <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                    </td>
                                    <td>{{$dado->nome}}</td>
                                    <td>{{$dado->bi}}</td>
                                    <td>{{$dado->departamento}}</td>
                                </tr>
                                @endforeach   
                            </tbody>
                        </table>         
                    </div>
                </div>
            </div>
        <?php }else{ ?> 
        <!--Fim do conteudo-->
        <!--Inicio do conteudo docente e estudante-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
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
                                        <table id="paginationDocente" class="table table-bordered mb-0">
                                            <thead id="cabecatabela">
                                                <tr>
                                                    <th class="font-weight-medium"></th>
                                                    <th class="font-weight-medium">Nome Completo</th>
                                                    <th class="font-weight-medium">Documento Nº</th>
                                                    <th class="font-weight-medium">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dados as $dado)
                                                <tr title="Clique aqui para ver utilizador" class="clickable-row tabelaClicked" data-href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}'>
                                                    <td >
                                                        <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                    </td>
                                                    <td>{{$dado->nome}}</a></td>
                                                    <td>{{$dado->bi}}</td>
                                                    <td>{{$dado->email}}</td>
                                                </tr>
                                                @endforeach   
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Listagem de estudantes-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <table id="paginationEstudante" class="table table-bordered mb-0">
                                            <thead id="cabecatabela">
                                                <tr>
                                                    <th class="font-weight-medium"></th>
                                                    <th class="font-weight-medium">Nome Completo</th>
                                                    <th class="font-weight-medium">Documento Nº</th>
                                                    <th class="font-weight-medium">Curso</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dadosEstudante as $dado)
                                                <tr title="Clique aqui para ver utilizador" class="clickable-row tabelaClicked" data-href='{{ url("verperfilUtilizador/".base64_encode($dado->id)."/".base64_encode($dado->tipo)) }}'>
                                                    <td >
                                                        <img src="{{ url('images/users/user.jpg') }}" alt="task-user" class="avatar-sm img-thumbnail rounded-circle"> 
                                                    </td>
                                                    <td>{{$dado->nome}}</td>
                                                    <td>{{$dado->bi}}</td>
                                                    <td>{{$dado->email}}</td>
                                                </tr>
                                                @endforeach   
                                            </tbody>
                                        </table>                
                                    </div>
                                </div> 
                            </div> 
                        </div> 
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

        $('#paginationDocente').DataTable({
			"pagingType": "full_numbers"
		});

        $('#paginationEstudante').DataTable({
			"pagingType": "full_numbers"
		});
	});

    jQuery().ready(function(){
        $(".clickable-row").click(function(){
            window.location = $(this).data("href");
        });
    });
</script>
@stop