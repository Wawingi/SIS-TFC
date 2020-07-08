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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Configurações</a></li>
                            <li class="breadcrumb-item active">Perfil de Utilizador</li>
                        </ol>
                    </div>                   
                    <h4 class="page-title">Perfil do Utilizador</h4>
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
        @include('includes.configuracao.modalEditarPerfil')


        <?php                 
            //dd(App\Role::pegaPerfilUtilizador(5));
        ?>

        <!--Inicio do conteudo-->          
            <br><br>
            <div class="card-box">
                <div class="row">                            
                    <div class="col-4">
                        <div class="card-box">
                            <form id="formularioSalvar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="ex: Administrador">
                                </div>    
                                <div class="form-group">
                                    <label for="name">Descrição</label>
                                    <input type="text" class="form-control" name="descricao" placeholder="ex: Administrador funcionário">
                                </div> 
                                @if($sessao[0]->tipo==2)   
                                    <div class="form-group">
                                        <label for="name">Tipo</label><br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="2"> Docente
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="tipo" id="tipo" value="3"> Estudante
                                            </label>
                                        </div>
                                    </div>
                                @elseif($sessao[0]->tipo==1)
                                    <input class="form-check-input" type="hidden" name="tipo" id="tipo" value="1">
                                @endif     
                                <hr>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-content-save mr-1"></i>Registar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-box">
                            <table id="paginationFullNumbers" class="table table-bordered" width="100%">
                                <thead id="cabecatabela">
                                    <tr>
                                        <th>Perfil</th>
                                        <th>Descrição</th>
                                        <th class="text-center" style="width: 125px">Acções</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTable">
                                                            
                                </tbody>
                            </table>
                            <hr style="margin-top:-15px">
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="accordion mb-3" id="accordionExample">
                                        <div class="mb-1">
                                            <div id="headingOne">
                                                <h5 class="my-0">
                                                    <a class="text-primary btn btn-warning btn-sm waves-effect waves-light btn-rounded" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <i class="far fa-trash-alt mr-1 AcordeonLixeira"></i><h7 class="AcordeonLixeira">Perfis Eliminados</h7>
                                                    </a>
                                                </h2>
                                            </div>
                                            <br>                                            
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">                                              
                                                <table id="paginationFullNumbers2" class="table table-bordered" width="100%">
                                                    <thead id="cabecatabela">
                                                        <tr>
                                                            <th>Perfil</th>
                                                            <th>Descrição</th>
                                                            <th class="text-center" style="width: 125px">Acções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dataTableLixeira">
                                                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>                                                                                    
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div> 
                  
        <!-- FIm do conteudo -->
    </div> 
</div>
<script>
    function carregarDataTable(){
        var isDeleted=0;
        $.ajax({
            url: "{{ url('pegaPerfilUtilizador') }}/"+isDeleted,
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

    function carregarDataTableLixeira(){
        var isDeleted=1;
        $.ajax({
            url: "{{ url('pegaPerfilUtilizador') }}/"+isDeleted,
            success:function(data){
                $('#dataTableLixeira').html(data);
                $('#paginationFullNumbers2').DataTable({
                    "pagingType": "full_numbers"
                });
            },
            error: function(e)
			{
				alert("Erro ao carregar dados");
			}
        })
    }

    carregarDataTableLixeira();

    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('registarPerfil') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Swal.fire({
                        text: "Perfil registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    })             
                    carregarDataTable();
                    $('#formularioSalvar')[0].reset();
                }            
            },
            error: function(e){
                $('#formularioSalvar')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao registar o perfil.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
        var descricao = $(this).attr('desc');

        $('.editar').modal('show');

        $('#nome_edit').val(nome);
        $('#id_edit').val(id);
        $('#desc_edit').val(descricao);
    });

    $('#formularioEditar').submit(function(e){
        e.preventDefault();

        var request = new FormData(this);

        $.ajax({
            url:"{{ url('editarPerfil') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Perfil Actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    //carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o perfil.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar o perfil? OBS: Poderá restaurá-lo.',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('eliminarPerfil') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            carregarDataTableLixeira();
                            Swal.fire(
                            'Eliminado!',
                            'Eliminado com Sucesso.',
                            'success'
                            )
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

    $(document).on('click','.restaurar',function(e){
        Swal.fire({
			  title: 'Deseja restaurar o perfil?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Restaurar',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('restaurarPerfil') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            carregarDataTableLixeira();
                            Swal.fire(
                            'Restaurado!',
                            'Restaurado com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao restaurar o perfil.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
		});
    });
</script>    
@stop