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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Propostas & Sugestões</a></li>
                            <li class="breadcrumb-item active">Meus Tutorandos</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>       
        <!--Inicio do conteudo-->      
            <br>        
            
            <div class="card-box">           
                <div class="row">
                    <div class="col-lg-12">             
                        <a href='{{ url("listarSugestaoDepartamento")}}' class=" waves-effect waves-light"><i class="mdi mdi-subdirectory-arrow-left mr-1"></i>Ir para Geral Sugestões</a>     
                    </div>
                </div>
            </div>      


            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>#</th>
                                    <th>Tema</th>
                                    <th>Área de Aplicação</th>
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

    function carregarDataTable(){
        $.ajax({
            url: "{{ url('pegaSugestoesOrientador') }}",
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
                    //carregarDataTable();
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
    /*
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
    });*/
</script>    
@stop