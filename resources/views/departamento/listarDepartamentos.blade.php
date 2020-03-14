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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Departamentos</a></li>
                            <li class="breadcrumb-item active">Listar Departamentos</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
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
        <br><br>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-4">  
                                <a href="#save-modal" class="btn btn-primary waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-plus-circle mr-1"></i> Adicionar Departamento</a>     
                            </div><!-- end col-->
                        </div> <!-- end row -->
                    </div> <!-- end card-box -->
                </div><!-- end col-->
            </div>
            <!-- Inclusão da Modal -->
            @include('includes.departamento.modalDepartamento')
            @include('includes.departamento.modalEditarDepartamento')
            <a id="modalEditar" style="display:none" href="#edit-modal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
            
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table class="table mb-0">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>#</th>
                                    <th>Departamento</th>
                                    <th>Chefe do Departamento</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">
                           
                            </tbody>
                        </table>
                        <hr>
                        <!-- $departamentos->links() -->
                        </div>
                    </div> 
                </div>
            </div>
    </div> 
</div>
<script>
    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaDepartamentos') }}",
            success:function(data){
                $('#dataTable').html(data);
            },
            error: function(e)
			{
				alert(e);
			}
        })
    }
    carregarDataTable();

    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('registarDepartamento') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Custombox.modal.close();
                    Swal.fire({
                        text: "Departamento registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao registar o departamento.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ url('pegaDepartamento') }}/"+id,
            method: "GET",
            dataType: "JSON",
            success: function(data){                
                $('#modalEditar').click();
                $('#nome_edit').val(data.nome);
                $('#chefe_departamento').val(data.chefe_departamento);
                $('#email').val(data.email);
                $('#telefone').val(data.telefone);
                $('#id_departamento').val(data.id);
            },
            error: function(e)
            {
                
            }
        });
    });

    $('#formularioEditar').submit(function(e){
        e.preventDefault();

        var request = new FormData(this);

        $.ajax({
            url:"{{ url('editarDepartamento') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Departamento Actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarDataTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o departamento.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar o departamento?',
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
                        url: "{{ url('eliminarDepartamento') }}/"+id,
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
</script>    
@stop