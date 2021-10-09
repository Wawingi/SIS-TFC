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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trabalhos</a></li>
                            <li class="breadcrumb-item active">Trabalhos Defendidos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Trabalhos Defendidos</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <br>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                        <thead id="cabecatabela">
                            <tr>
                                <th>#</th>
                                <th>Tema</th>
                                <th>Área de Aplicação</th>
                                <th>Nota da Defesa</th>
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
            url: "{{ url('pegaTrabalhosDefendidos') }}",
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
