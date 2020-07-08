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
                            <li class="breadcrumb-item active">Sugestão de Estudantes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sugestão de Estudantes</h4>
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

        <!--Inicio do conteudo-->
        <br><br>
        @if($sessao[0]->tipo==3)           
            <div class="row">
                <?php                   
                    $jaSugestao = App\Model\Pessoa::verificarEnvolvimentoSugestao($sessao[0]->id_pessoa,1);
                    if(count($jaSugestao) <= 0){
                ?> 
                    <div class="col-lg-12">                  
                        <button type="button" class="btn btn-primary btn-rounded btn-sm waves-effect waves-light" data-toggle="modal" data-target="#exampleModalScrollable"><i class="mdi mdi-plus-circle mr-1"></i>Adicionar Proposta</button>
                    </div>
                <?php }else{ ?>
                    <div class="col-lg-6">                  
                        <h5 class="SairGrupo"><i class="mdi mdi-file-lock"></i> JÁ POSSUI UMA PROPOSTA  ASSOCIADA.</h5>
                    </div>
                    <div class="col-lg-6">
                        <a href='{{ url("verSugestao/".base64_encode($jaSugestao[0]->id_sugestao)) }}' class="btn-rounded btn btn-success btn-sm waves-effect waves-light float-right"><i class="fas fa-folder-open mr-1"></i>Visualizar Proposta</a>
                    </div>
                <?php } ?>
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
            </div>       
        <!-- FIm do conteudo -->
    </div> 
</div>
<script>
  

    //Função para escolha multipla de nomes de envolventes
    $(document).ready(function() {
		$('.js-example-basic-multiple').select2({
            tags: "true",
            placeholder: "Selecione os envolventes",
            allowClear: true
        });
	});

    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaSugestoesEstudante') }}",
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
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao registar a sugestão.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    //validação da escolha da modalidade da sugestão(individual ou colectiva)
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
</script>    
@stop