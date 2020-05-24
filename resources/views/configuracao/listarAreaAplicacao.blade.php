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
                            <li class="breadcrumb-item active">Área de aplicação</li>
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
        @include('includes.configuracao.modalArea')
        @include('includes.configuracao.modalEditarArea')

        <!--Inicio do conteudo-->
            <br>  
            <div class="card-box">           
                <div class="row">
                    <div class="col-lg-12">             
                        <a href="#save-modal" class="btn btn-primary waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-plus-circle mr-1"></i> Adicionar  Linha de Investigação</a>     
                    </div>
                </div>
            </div>
            <br>        
            
            <a id="modalEditar" style="display:none" href="#edit-modal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
                
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Visibilidade</th>
                                    <th style="width:15%"></th>
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
            url: "{{ url('pegaAreasAplicacao') }}",
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
            url:"{{ url('registarArea') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Custombox.modal.close();
                    Swal.fire({
                        text: "Área registada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    }),
                    $('#formularioSalvar')[0].reset();
                    //carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao registar a área.',
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

        $('.editar').modal('show');

        $('#nome_edit').val(nome);
        $('#id_edit').val(id);
    });

   
    $('#formularioEditar').submit(function(e){
        e.preventDefault();

        var request = new FormData(this);

        $.ajax({
            url:"{{ url('editarArea') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Área Actualizada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    //carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar a área.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar a área? OBS: Poderá restaurá-lo.',
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
                        url: "{{ url('eliminarArea') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
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
			  title: 'Deseja restaurar a área?',
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
                        url: "{{ url('restaurarArea') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            Swal.fire(
                            'Restaurado!',
                            'Restaurado com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao restaurar a área.',
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