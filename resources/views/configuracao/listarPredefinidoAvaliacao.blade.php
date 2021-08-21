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
                            <li class="breadcrumb-item active">Avaliação Predefinida</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Avaliação Predefinida</h4>
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
        @include('includes.configuracao.modalEditarPredefinida')

        <!--Inicio do conteudo-->
            <br><br>  

            <div class="card-box">
                <div class="row">                            
                    <div class="col-4">
                        <div class="card-box">
                            <form id="formularioSalvar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Avaliação</label>
                                    <input type="text" required class="form-control" name="avaliacao" placeholder="ex: Tipografia">
                                </div>       
                                <div class="form-group">
                                    <label for="name">Descrição</label>
                                    <input type="text" required class="form-control" name="descricao" placeholder="ex: Tipografia não regularizada">
                                </div>       
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
                                        <th>Avaliação</th>
                                        <th>Descrição</th>
                                        <th style="width:15%">Acções</th>
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
            url: "{{ url('pegaPredefinidaAvaliacao') }}",
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
            url:"{{ url('registarPredefinidaAvaliacao') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == 1){
                    //Custombox.modal.close();
                    Swal.fire({
                        text: "AValiação predefinida registada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarDataTable();
                }            
            },
            error: function(e){
                $('#formularioSalvar')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao registar.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });
    
    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var avaliacao = $(this).attr('avaliacao');
        var descricao = $(this).attr('descricao');

        $('.editar').modal('show');

        $('#id').val(id);
        $('#avaliacao').val(avaliacao);
        $('#descricao').val(descricao);
    });

   
    $('#formularioEditar').submit(function(e){
        e.preventDefault();

        var request = new FormData(this);

        $.ajax({
            url:"{{ url('editarPredefinida') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data ==1){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Avaliação predefinida actualizada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioEditar')[0].reset();
                    carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar a avaliação.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar a avaliação predfinida?',
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
                        url: "{{ url('eliminarPredefinida') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            Swal.fire(
                            'Eliminado!',
                            'Eliminada com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar a avaliação predefinida.',
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