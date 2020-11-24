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
                            <li class="breadcrumb-item active">Ver Trabalho</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ver Trabalho</h4>
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


        <!--Inicio do conteudo-->
                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#dados" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-book-open"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-book-open"></i> Dados</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#descricao" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-file-pdf"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-file-pdf"></i> Descrição</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#evolucao" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-clipboard-list"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-clipboard-list"></i> Evolução do Trabalho</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#predefesa" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-user-edit"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-user-edit"></i> Pré Defesas</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#provapublica" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-user-graduate"></i></span>
                                                <span class="d-none d-sm-inline-block"><i class="fas fa-user-graduate"></i> Prova Pública</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="dados">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                                                <li style="background:#fff;height:180px" id="task1" class="task-low">
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
                                                                <p class="col-md-5 col-form-label"> Data de aprovação</p>
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
                                                                <p class="col-md-5 col-form-label"> Estado</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">:
                                                                    <span class="check">Em desenvolvimento</span> <i style="color:#007c00" class='fas fa-check-circle mr-3'></i>
                                                                </label>
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

                                <div class="tab-pane fade" id="descricao">
                                    <iframe
                                        src='{{ url("/storage/propostas/{$trabalho->descricao}") }}'
                                        type="applicatios/pdf"
                                        height="700px"
                                        width="100%">
                                    </iframe>
                                </div>

                                <div class="tab-pane fade" id="evolucao">
                                    <div id="card-view" class="card-body">

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="predefesa">
                                    <div id="card-view" class="card-body">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="provapublica">
                                    <div id="card-view" class="card-body">

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

    /*
    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('rejeitarProposta') }}",
            type: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $("#modalRejeitarClose").click();
                    $('#formularioSalvar')[0].reset();
                    Swal.fire({
                        text: "Rejeitado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    });
                    location.reload();
                }
            },
            error: function(e){
                $("#modalRejeitarClose").click();
                $('#formularioSalvar')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao registar.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });








    function getMotivoRejeicao(){
        var idSugestao = $('#sugestao_id').val(); //id da sugestão selecionada
        $.ajax({
            url: "{{ url('verMotivoRejeicao') }}/"+idSugestao,
            success:function(data){
                $('#motivorejeicao').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados");
			}
        })
    }
    getMotivoRejeicao();*/

</script>
@stop
