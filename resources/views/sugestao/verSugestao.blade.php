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
                            <li class="breadcrumb-item active">Ver Sugestão</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ver Sugestão</h4>
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
        @include('includes.sugestao.modalTrabalharSugestao')
        @include('includes.sugestao.modalAvaliarSugestao')
        @include('includes.sugestao.modalNovoEstudante')
        @include('includes.sugestao.modalNovoTutor')

        <!--Inicio do conteudo-->
        @if($notificacao==1)
            <div class="alert alert-warning" role="alert">
                <i class="mdi mdi-alert-outline mr-2"></i><strong>Foste selecionado a fazer parte deste grupo para desenvolver o tema abaixo</strong>
                <div class="button-list">
                    <a style="bottom:32px" href="#" idPessoa="{{$sessao[0]->id_pessoa}}" idSugestao="{{$sugestao[0]->id}}" class="NegarProposta btn btn-danger btn-rounded btn-sm waves-effect waves-light float-right"><i class="mdi mdi-cancel mr-1"></i>Negar Proposta</a>
                    <a style="bottom:32px" href="#" idPessoa="{{$sessao[0]->id_pessoa}}" idSugestao="{{$sugestao[0]->id}}" class="AceitarProposta btn btn-success btn-rounded btn-sm waves-effect waves-light float-right"><i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>Aceitar Proposta</a>
                </div>
            </div>
        @endif
                <br>

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-4">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#dados" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                                <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                                                <span class="d-none d-sm-inline-block">Dados</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#descricao" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                                <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                                                <span class="d-none d-sm-inline-block">Descrição</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#avaliacao" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                                                <span class="d-none d-sm-inline-block">Avaliação Técnica</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-8 ">
                                @can('aprovar_rejeitar_proposta')
                                    @if($sugestao[0]->avaliacao==0 || $sugestao[0]->avaliacao==1 || ($sugestao[0]->estado==1 && $sugestao[0]->proveniencia==1))
                                        <div class="float-right">
                                            <div style="margin-top:25px" class="button-list">
                                                <a style="bottom:32px" href="#rejeicao-modal" class="disabled btn btn-danger btn-rounded btn-sm waves-effect waves-light float-right" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-cancel mr-1"></i>Rejeitar Proposta</a>
                                                <a style="bottom:32px" href="#" class="disabled AprovarProposta btn btn-success btn-rounded btn-sm waves-effect waves-light float-right" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>Aprovar Proposta</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="float-right">
                                            <div style="margin-top:25px" class="button-list">
                                                <a style="bottom:32px" href="#" data-toggle="modal" data-target="#modalRejeitar" data-backdrop="static" data-keyboard="false" class="btn btn-danger btn-rounded btn-sm waves-effect waves-light float-right"><i class="mdi mdi-cancel mr-1"></i>Rejeitar Proposta</a>
                                                <a style="bottom:32px" href='{{ url("aprovarProposta/{$sugestao[0]->id}") }}' class="AprovarPropostaaa btn btn-success btn-rounded btn-sm waves-effect waves-light float-right"><i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>Aprovar Proposta</a>
                                            </div>
                                        </div>
                                    @endif
                                @endcan
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="dados">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                                                <li id="task1" class="<?php if ($sugestao[0]->estado == 4) {echo 'task-high';} else {echo 'task-low';}?>">
                                                    <br>
                                                    <input type="hidden" name="sugestao_id" id="sugestao_id" class="form-control" value="{{$sugestao[0]->id}}">
                                                    <input type="hidden" name="sugestao_descricao" id="sugestao_descricao" class="form-control" value="{{$sugestao[0]->descricao}}">
                                                    <input type="hidden" name="sugestao_proveniencia" id="sugestao_proveniencia" class="form-control" value="{{$sugestao[0]->proveniencia}}">
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Tema</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$sugestao[0]->tema}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Área de aplicação</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$sugestao[0]->area}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Orientador</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-7 col-form-label">: {{$sugestao[0]->docente}}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="labelespaco" class="row">
                                                        <div class="col-5">
                                                            <div class="form-group row mb-3">
                                                                <p class="col-md-5 col-form-label"> Estado</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-7">
                                                            <div class="form-group row mb-3">
                                                                <label class="col-md-5 col-form-label">:
                                                                    @if($sugestao[0]->estado==1)
                                                                        Registado
                                                                    @elseif($sugestao[0]->estado==2)
                                                                        Selecionado
                                                                    @elseif($sugestao[0]->estado==3)
                                                                        Em desenvolvimento
                                                                    @elseif($sugestao[0]->estado==4)
                                                                        Rejeitado
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="descricao">
                                    <iframe
                                        src='{{ url("/storage/propostas/{$sugestao[0]->descricao}") }}'
                                        type="applicatios/pdf"
                                        height="700px"
                                        width="100%">
                                    </iframe>
                                </div>
                                <div class="tab-pane fade" id="avaliacao">
                                    <div id="card-view" class="card-body">
                                    @if($sugestao[0]->estado==4)
                                        <div id="rejeitado">
                                            <div class="row">
                                                <div id="icone_resultado_proposta" class="col-12">
                                                    <br>
                                                    <img width="100px" heigth="100px" src="{{ url('images/rejeitar.png') }}"/>
                                                    <p class="proposta-rejeitada">PROPOSTA REJEITADA</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row descricaoSugestao">
                                                <div class="col-lg-12">
                                                    <div class="accordion mb-3" id="accordionExample">
                                                        <div class="card mb-1">
                                                            <div class="card-header" id="headingOne">
                                                                <h5 class="my-0">
                                                                    <a class="text-primary" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                        <i class="fas fa-info-circle"></i> Motivo da Rejeição
                                                                    </a>
                                                                </h2>
                                                            </div>
                                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                <div class="card-body">
                                                                    <p id="motivorejeicao"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($sugestao[0]->estado==3)
                                        <div class="row">
                                            <div id="icone_resultado_proposta" class="col-12">
                                                <br>
                                                <img width="100px" heigth="100px" src="{{ url('images/check.png') }}"/>
                                                <p class="proposta-aceite">PROPOSTA APROVADA COM SUCESSO.</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div id="icone_resultado_proposta" class="col-12">
                                                <br>
                                                <img width="100px" heigth="100px" src="{{ url('images/aguardando.png') }}"/>
                                                <p class="proposta-espera">AGUARDANDO APROVAÇÃO.</p>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                        <br>
                                        <?php
$jaSugestao = App\Model\Pessoa::verificarEnvolvimentoSugestao($sessao[0]->id_pessoa, 1);
?>
                                        @if($sessao[0]->tipo==3 && $sugestao[0]->estado==1 && $sugestao[0]->proveniencia==1 && count($jaSugestao)<=0)
                                            <a href="#save-modal" class="btn btn-success btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target="#modalTrabalharSugestao"><i class="mdi mdi-worker mr-1"></i> Trabalhar na Sugestão</a>
                                        @elseif($sessao[0]->tipo==3 && $sugestao[0]->estado==1 && $sugestao[0]->proveniencia==1 && count($jaSugestao)>=0)
                                            <h5 class="SairGrupo"><i class="mdi mdi-file-lock"></i> JÁ POSSUI UMA PROPOSTA  ASSOCIADA.</h5>
                                        @endif
                                </div>
                                @can('menu_sugestao')
                                    <div class="col-2">
                                        <div class="float-right btn-group dropdown mt-1">
                                            <button type="button" class="btn-sm btn btn-primary waves-effect waves-light">Menu</button>
                                            <button type="button" class="btn-sm btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-chevron-down"></i></button>
                                            <div class="dropdown-menu">
                                                @if($sugestao[0]->estado==2 || ($sugestao[0]->estado==1 && $sugestao[0]->proveniencia==2))
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#novoestudanteModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-user-graduate noti-icon mr-2"></i>Adicionar estudante</a>
                                                @endif
                                                @if($sugestao[0]->estado==1 || $sugestao[0]->estado==2)
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#novotutor" data-backdrop="static" data-keyboard="false"><i class="fas fa-chalkboard-teacher noti-icon mr-2"></i>Trocar Orientador</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            <br>

            @if($sugestao[0]->proveniencia==2) <!--Tema vindo de estudante(s)-->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h5 class="table-title"><i class="fas fa-users mr-1"></i>ENVOLVENTES DO TEMA</h5><hr>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody id="dataTable">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($sugestao[0]->proveniencia==1) <!--Tema vindo do departamento-->
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class=row>
                                <div class="col-12">
                                    <h5 style="margin-top:8px" class="table-title"><i class="fas fa-users mr-1"></i>ENVOLVENTES DO TEMA</h5>
                                </div>
                            </div><hr>
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>BI Nº</th>
                                            <th>Curso</th>
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
            @endif
        <!-- FIm do conteudo -->
    </div>
</div>
<script>
    //validação da escolha da modalidade da sugestão(individual ou colectiva)
    document.getElementById("envolventes").style.display = 'none';
    document.getElementById("modalidade").onchange = function() {
        alterar();
    };
    function alterar() {
        var dado = document.getElementById("modalidade");
        var itemSelecionado = dado.options[dado.selectedIndex].value;
            if (itemSelecionado==="Individual") {
                document.getElementById("envolventes").style.display = 'none';
            }else {
                document.getElementById("envolventes").style.display = 'block';
            }
    }

    //Função para escolha multipla de nomes de envolventes
    $(document).ready(function() {
		$('.js-example-basic-multiple').select2({
            tags: "true",
            maximumSelectionLength:1,
            minimumSelectionLength:1,
            placeholder: "Selecione os envolventes",
            allowClear: true
        });
	});

    function carregarDataTable(){
        var sugestao_id = $('#sugestao_id').val(); //id da sugestão selecionada
        $.ajax({
            url: "{{ url('verEnvolventes') }}/"+sugestao_id,
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

    //Aprovar uma proposta pelo conselho cientifico do departamento
    $(document).on('click','.AprovarProposta',function(e){
        e.preventDefault();
        var idSugestao = $('#sugestao_id').val(); //id da sugestão selecionada

        $.ajax({
            url: "{{ url('aprovarProposta') }}/"+idSugestao,
            type: "GET",
            success: function(data){
                if(data == "Sucesso"){
                    Swal.fire({
                        text: 'Sugestão aprovada com Sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 3500
                    });
                    location.reload();
                }
            },
            error: function(e)
            {
                Swal.fire({
                    text: 'Ocorreu um erro ao aprovar a proposta.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });


    //Abandonar um grupo adicionado ou dum tema proposto
    $(document).on('click','.SairGrupo',function(e){
        Swal.fire({
			  title: 'Deseja realmente abandonar esta proposta?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Sim',
              cancelButtonText: 'Não'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var sugestao_id = $('#sugestao_id').val(); //id da sugestão selecionada
                    var sugestao_proveniencia = $('#sugestao_proveniencia').val();//proveniencia da sugestao
                    var idPessoa = $(this).attr('idPessoa');  //id da pessoa logada
                    var descricao = $('#sugestao_descricao').val(); //Descricao ou nome do anexo

                    $.ajax({
                        url: "{{ url('sairGrupo') }}/"+sugestao_id+"/"+idPessoa+"/"+sugestao_proveniencia+"/"+descricao,
                        type: "GET",
                        success: function(data){
                            Swal.fire({
                                text: 'Sugestão abandonada com Sucesso.',
                                icon: 'success',
                                confirmButtonText: 'Fechar',
                                timer: 3500
                            });

                            if(data == 'Sucesso_Estudante'){
                                location.href='{{ url("listarSugestaoEstudante") }}';
                                exit;
                            }
                            location.reload();
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao remover o perfil.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });


    $(document).on('click','.AceitarProposta',function(e){
        Swal.fire({
			  title: 'Se aceitares não poderás propôr outro tema ou adicionado à outro grupo.',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Aceitar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();

                    var idPessoa = $(this).attr('idPessoa');
                    var idSugestao = $(this).attr('idSugestao');

                    $.ajax({
                        url: "{{ url('aceitarProposta') }}/"+idPessoa+"/"+idSugestao,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            location.href=btoa(0);
                            Swal.fire({
                                text: "Adicionado na proposta.",
                                icon: 'success',
                                confirmButtonText: 'Fechar',
                                timer: 1500
                            })
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Erro ao abandonar a proposta.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });

    //Rejeição da proposta de um convite por parte de um estudante
    $(document).on('click','.NegarProposta',function(e){
        Swal.fire({
			  title: 'Deseja realmente negar este convite?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Negar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var idPessoa = $(this).attr('idPessoa');
                    var idSugestao = $(this).attr('idSugestao');
                    var sugestao_proveniencia = $('#sugestao_proveniencia').val();

                    $.ajax({
                        url: "{{ url('negarProposta') }}/"+idSugestao+"/"+idPessoa+"/"+sugestao_proveniencia,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            Swal.fire({
                                text: 'Proposta negada com Sucesso.',
                                icon: 'success',
                                confirmButtonText: 'Fechar',
                                timer: 1500
                            });
                            location.href=btoa(0);
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao negar a proposta.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });

    //Adicionar um novo estudante a um tema selecionado
    $('#formularioSalvarNovoEstudante').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('adicionarEstudante') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalCloseNovo').click();
                    Swal.fire({
                        text: "Estudante adicionado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    }),
                    $('#formularioSalvarNovoEstudante')[0].reset();
                    carregarDataTable();
                }
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao adicionar o estudante.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    //Trocar o orientador de uma determinada sugestão ou proposta
    $('#formularioNovoTutor').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('trocarTutor') }}",
            type: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalNovoTutorClose').click();
                    Swal.fire({
                        text: "Alterado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    });
                    location.reload();
                }
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro.',
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
    getMotivoRejeicao();

</script>
@stop