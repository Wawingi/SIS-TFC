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
                            <li class="breadcrumb-item active">Meus Tutorandos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Meus Tutorandos</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
            <br>

            <div class="card-box">
                <div class="row">
                    <div class="col-lg-12">
                        <a href='{{ url("trabalhoEmCurso")}}' class=" waves-effect waves-light"><i class="mdi mdi-subdirectory-arrow-left mr-1"></i>Ir para Geral Trabalhos</a>
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
                                    <th>Estado</th>
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
            url: "{{ url('pegaTrabalhosOrientador') }}",
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
