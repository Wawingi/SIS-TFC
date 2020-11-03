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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Temas</a></li>
                            <li class="breadcrumb-item active">Trabalhos em Curso</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Trabalhos em Curso</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <br>

        <div class="row text-center mb-2">
            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <i class="fab fa-readme font-24"></i>
                    <h3>100</h3>
                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Trabalhos em Progresso</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <i class="fas fa-tools font-24"></i>
                    <h3 class="text-warning">5</h3>
                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Áreas de Aplicação</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <i class="fas fa-user-tie font-24"></i>
                    <h3 class="text-success">10</h3>
                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Orientadores Envolvidos</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card-box">
                    <i class="fas fa-user-graduate font-24"></i>
                    <h3 class="text-danger">250</h3>
                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Total de Estudantes</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                        <thead id="cabecatabela">
                            <tr>
                                <th>#</th>
                                <th>Tema</th>
                                <th>Área de Aplicação</th>
                                <th>Docente</th>
                            </tr>
                        </thead>
                        <tbody id="dataTable">
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaTemas') }}",
            success:function(data){
                $('#dataTable').html(data);
                $('#paginationFullNumbers').DataTable({
                    "pagingType": "full_numbers"
                });
            },
            error: function(e)
			{
				alert("erro ao carregar dados");
			}
        })
    }
    carregarDataTable();
</script>
@stop
