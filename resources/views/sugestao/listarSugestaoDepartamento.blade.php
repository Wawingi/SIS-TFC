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
                            <li class="breadcrumb-item active">Sugestão do Departamento</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sugestão do Departamento</h4>
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

        <!-- Inclusão da Modal -->
        @include('includes.sugestao.modalSugestao')
        @include('includes.departamento.modalEditarDepartamento')

        <!--Inicio do conteudo-->
        <br><br>
        @if($sessao[0]->tipo==2)
            <div class="row float-right">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-rounded btn-sm btn-primary waves-effect waves-light" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#exampleModalScrollable"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Sugestão</button>
                </div>
            </div>
        @endif
            <br><br>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>#</th>
                                    <th>Tema</th>
                                    <th>Área de Aplicação</th>
                                    <th>Orientador</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaSugestoesDPTO') }}",
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

    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('registarSugestao') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalClose').click();
                    Swal.fire({
                        text: "Sugestão registada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarDataTable();
                }else{
                    $('#formularioSalvar')[0].reset();
                    $('#modalClose').click();
                    Swal.fire({
                        text: 'Ocorreu um erro ao registar a sugestão. Verifique a extensão ou o tamanho do seu ficheiro.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            },
            error: function(e){
                $('#formularioSalvar')[0].reset();
                $('#modalClose').click();
                Swal.fire({
                    text: 'Ocorreu um erro ao registar a sugestão. Verifique a extensão ou o tamanho do seu ficheiro.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
</script>
@stop
