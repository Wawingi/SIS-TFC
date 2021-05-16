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
                            <li class="breadcrumb-item active">Ver Trabalho Defendido</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Trabalho Defendido</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">               
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                                        <li style="background:#fff;height:auto" id="task1" class="task-low">
                                            <br>
                                            <input type="hidden" name="trabalho_id" id="trabalho_id" class="form-control" value="{{$trabalho->id}}">
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label"> Tema</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: {{$trabalho->tema}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label"> Área de aplicação</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: {{$trabalho->area}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label"> Data da defesa</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: {{ date('d/m/Y',strtotime($trabalho->created_at)) }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label"> Orientador</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: {{$trabalho->docente}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label"> Nota</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: {{$trabalho->nota}} Valores</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="labelespaco" class="row">
                                                <div class="col-4">
                                                    <div class="form-group row mb-3">
                                                        <p class="col-md-5 col-form-label">Relatório final</p>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group row mb-3">
                                                        <label class="col-md-7 col-form-label">: <a href="#">{{$trabalho->descricao}} <i class="fas fa-file-pdf"></i></a></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <h5 class="table-title"><i class="fas fa-users mr-1"></i>ESTUDANTES ENVOLVIDOS</h5><hr>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>BI Nº</th>
                                                        <th>Curso</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="dataTable">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
            <br>
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
    function carregarDataTable(){
        var trabalho_id = $('#trabalho_id').val(); //id da sugestão selecionada
        //var sugestao_estado = $('#sugestao_estado').val(); //id da sugestão selecionada
        $.ajax({
            url: "{{ url('verEnvolventesTrabalho') }}/"+trabalho_id,
            success:function(data){
                $('#dataTable').html(data);
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
