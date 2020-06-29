<?php 
    //sessão dos dados do utilizador logado
    $sessao=session('dados_logado'); 
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
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-4">
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
                                @can('aprovar_rejeitar_proposta')
                                    <div class="co-lg-8">
                                        <div style="margin-left:450px;margin-top:25px" class="button-list">
                                            <a style="bottom:32px" href="#save-modal" class="<?php if($sugestao[0]->avaliacao==0){echo 'disabled';} ?> RejeitarTema btn btn-danger btn-rounded btn-sm waves-effect waves-light float-right" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-cancel mr-1"></i>Rejeitar Proposta</a>
                                            <a style="bottom:32px" href="#" class="<?php if($sugestao[0]->avaliacao==0){echo 'disabled';} ?> AceitarProposta btn btn-success btn-rounded btn-sm waves-effect waves-light float-right"><i class="mdi mdi-checkbox-marked-circle-outline mr-1"></i>Aprovar Proposta</a>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="dados">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="sortable-list tasklist list-unstyled" id="upcoming">
                                                <li id="task1" class="<?php if($sugestao[0]->estado==4){echo 'task-high';}else{echo 'task-low';} ?>">
                                                    <br>
                                                    <input type="hidden" name="sugestao_id" id="sugestao_id" class="form-control" value="{{$sugestao[0]->id}}">
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
                                                                        Publicado
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
                                    <div id="card-view" class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>                                                                                                                                   
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
                                    @endif    
                                    </div>
                                </div>
        
                            </div>
                                <br>
                                <?php                   
                                    $jaSugestao = App\Model\Pessoa::verificarEnvolvimentoSugestao($sessao[0]->id_pessoa,1);
                                ?> 
                                @if($sessao[0]->tipo==3 && $sugestao[0]->estado==1 && $sugestao[0]->proveniencia==1 && count($jaSugestao)<=0)
                                    <a href="#save-modal" class="btn btn-success btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target="#modalTrabalharSugestao"><i class="mdi mdi-worker mr-1"></i> Trabalhar na Sugestão</a>
                                @elseif($sessao[0]->tipo==3 && $sugestao[0]->estado==1 && $sugestao[0]->proveniencia==1 && count($jaSugestao)>=0)
                                    <h5 class="SairGrupo"><i class="mdi mdi-file-lock"></i> JÁ POSSUI UMA PROPOSTA  ASSOCIADA.</h5>                    
                                @endif   
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
    
    $('#envolventes').hide();
    
    $(document).ready(function(){
        $('.switchery').click(function(){
            if($(this).prop("checked") == true){
                $('#envolventes').hide();
            }else{
                $('#envolventes').show();
            }
        });
    });    

    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('#envolventes').show();
            }else{
                $('#envolventes').hide();
            }
        });
    });

    //Função para escolha multipla de nomes de envolventes
    $(document).ready(function() {
		$('.js-example-basic-multiple').select2({
            tags: "true",
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

    $(document).on('click','.SairGrupo',function(e){
        Swal.fire({
			  title: 'Deseja realmente sair deste grupo?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Sair',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var sugestao_id = $('#sugestao_id').val(); //id da sugestão selecionada
                    var sugestao_proveniencia = $('#sugestao_proveniencia').val();//proveniencia da sugestao
                    var idPessoa = $(this).attr('idPessoa');  //id da pessoa logada

                    $.ajax({
                        url: "{{ url('sairGrupo') }}/"+sugestao_id+"/"+idPessoa+"/"+sugestao_proveniencia,
                        type: "GET",
                        success: function(data){         
                            Swal.fire({
                                text: 'Sugestão abandonada com Sucesso.',
                                icon: 'success',
                                confirmButtonText: 'Fechar',
                                timer: 3500
                            });
                            if(data == 'Sucesso_Estudante'){
                                location.href="{{ url('listarSugestaoEstudante') }}";
                            }
                            carregarDataTable();

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

    //Rek=jeição da proposta de um convite por parte de um estudante
    $(document).on('click','.NegarProposta',function(e){
        Swal.fire({
			  title: 'Deseja realmente rejeitar esta proposta?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Sair',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var idPessoa = $(this).attr('idPessoa');
                    var idSugestao = $(this).attr('idSugestao');

                    $.ajax({
                        url: "{{ url('sairGrupo') }}/"+idSugestao+"/"+idPessoa,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            
                            Swal.fire({
                                text: 'Proposta rejeitada com Sucesso.',
                                icon: 'success',
                                confirmButtonText: 'Fechar',
                                timer: 1500
                            });
                            location.href=btoa(0);
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao abandonar a proposta.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
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
    /*$(document).on('click','.AceitarProposta',function(e){
        //e.preventDefault();
        var idPessoa = $(this).attr('idPessoa');
        var idSugestao = $(this).attr('idSugestao');

        alert(idPessoa);

        $.ajax({
            url:"{{ url('aceitarProposta') }}/"+idPessoa+"/"+idSugestao,
            type: "GET",
            success:function(data){
                if(data == "Sucesso"){
                    Swal.fire({
                        text: "sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
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
    });*/

    

</script>    
@stop