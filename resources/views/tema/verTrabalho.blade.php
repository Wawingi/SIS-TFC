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
                                <!-- Secção da evolução do trabalho -->
                                <div class="tab-pane fade" id="evolucao">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div id="accordion" class="mb-3">
                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingOne">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS PRÉ-TEXTUAIS
                                                            </a>
                                                            <a id="showBtnAdicionar1" class="float-right" href="#" onclick="mudaAnexoElemento()"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Ficheiro</a>
                                                            <a id="showBtnCancelar1" style="display:none" class="float-right" href="#" onclick="fecharAnexo(1)"><i class="mdi mdi-close mr-1"></i>Cancelar</a>
                                                        </h5>
                                                    </div>
                                        
                                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                        <div class="card-body">
                                                            <div id="showAnexo1" style="display:none" class="row">
                                                                <div class="col-12">
                                                                <form id="formPretextual" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input required type="hidden" value="{{$trabalho->id}}" class="form-control"  name="trabalho_id" id="trabalho_id">    
                                                                    <input required type="hidden" value="{{$trabalho->tema}}" class="form-control"  name="trabalho_tema" id="trabalho_tema">    
                                                                    <input required type="hidden" value="1" class="form-control" name="titulo" id="titulo">    
                                                                    <div class="input-group">
                                                                        <input type="file" required class="form-control form-control-sm" placeholder="Escolha o ficheiro" accept="application/pdf" id="anexo" name="anexo">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-sm btn-success waves-effect waves-light" type="submit">OK</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody id="tablePretextual">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>                                                            
                                                            <div id="showFormAvaliar" style="display:none">
                                                                <hr>
                                                                <form method="POST" action="{{ url('avaliarItem') }}">
                                                                    @csrf
                                                                    <input type="hidden" id="id_item" name="id_item">
                                                                    <div class="form-group row mb-0">                                                                       
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group mb-3">
                                                                                <label for="genero">Avaliação</label><br>
                                                                                <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                                                    <input type="radio" id="valor" onclick="mudarAValiacao(1)" value="1" name="avaliacao" checked>
                                                                                    <label for="inlineRadio1"> Positiva </label>
                                                                                </div>
                                                                                <div class="radio form-check-inline">
                                                                                    <input type="radio" id="valor" onclick="mudarAValiacao(0)" value="0" name="avaliacao">
                                                                                    <label for="inlineRadio2"> Negativa </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div style="display:none" id="mostraComentario" class="col-sm-8">
                                                                            <div class="form-group mb-3">
                                                                                <label for="genero">Comentário</label><br>
                                                                                <textarea name="comentario" type="text" class="form-control" placeholder="Escreva o seu comentário referente ao conteúdo"></textarea>                                                    
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr style="margin-top:-10px">
                                                                    <button type="submit" class="btn btn-primary btn-rounded"><i class="far fa-save"> Avaliar </i></button>
                                                                    <button type="button" onclick="showAvaliacaoElemento(0)" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Cancelar </i></button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Fim Elemento Pre Textual-->                        
                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingTwo">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" data-toggle="collapse" href="#collapseTwo" aria-expanded="false">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS TEXTUAIS
                                                            </a>
                                                            
                                                        </h5>
                                                    </div>
                                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                        <div class="card-body">
                                                            Pos text
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card mb-1">
                                                    <div class="card-header" id="headingThree">
                                                        <h5 class="m-0">
                                                            <a class="text-dark" data-toggle="collapse" href="#collapseThree" aria-expanded="false">
                                                                <i class="mdi mdi-notebook mr-1 text-primary"></i> 
                                                                ELEMENTOS PÓS-TEXTUAIS
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                        <div class="card-body">
                                                            pos text
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
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

    function mudaAnexoElemento(){
        document.getElementById("showAnexo1").style.display = 'block';
        document.getElementById("showBtnAdicionar1").style.display = 'none';
        document.getElementById("showBtnCancelar1").style.display = 'block';
    };

    function fecharAnexo(){
        document.getElementById("showAnexo1").style.display = 'none';
        document.getElementById("showBtnAdicionar1").style.display = 'block';
        document.getElementById("showBtnCancelar1").style.display = 'none';
    };

    //Mostrar e ocultar a parte da avaliação de um elemento ou item
    function showAvaliacaoElemento(op,id_item){
        if(op==1){
            document.getElementById("showFormAvaliar").style.display = 'block';
            document.getElementById("id_item").value = id_item;
        } else
            document.getElementById("showFormAvaliar").style.display = 'none';
    }

    //Mostar a inout comentario caso avaliacao seja negativa
    function mudarAValiacao(av){
        if(av==0)
            document.getElementById("mostraComentario").style.display = 'block';
        else 
            document.getElementById("mostraComentario").style.display = 'none';
    }

    //Mostrar os dados do item pretextual
    function carregarTablePretextual(){
        var id_trabalho = $('#trabalho_id').val();
        var item_tipo=1;
        $.ajax({
            url: "{{ url('pegaItemPretextual') }}/"+id_trabalho+"/"+item_tipo,
            success:function(data){
                $('#tablePretextual').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados");
			}
        })
    };

    carregarTablePretextual();


    $('#formPretextual').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('registarItem') }}",
            type: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#formPretextual')[0].reset();
                    Swal.fire({
                        text: "Item registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    });
                    carregarTablePretextual();
                    fecharAnexo();
                }
            },
            error: function(e){
                $('#formPretextual')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao registar o item.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

</script>
@stop
