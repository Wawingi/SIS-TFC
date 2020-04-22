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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Listar Departamentos</a></li>
                            <li class="breadcrumb-item active">Ver Departamento</li>
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

        <!--Inicio do conteudo-->
        <br><br>    
        <div class="card-box">
            <h4 style="text-align:center;font-weight:bold" class="header-title">DADOS DO DEPARTAMENTO</h4><hr>
            <input type="hidden" class="form-control" value="{{$departamento->id}}" id="id_departamento" name="id_departamento">
            <div class="row">
                <div class="col-5">
                    <div class="form-group row mb-3">
                        <p class="col-md-5 col-form-label" for="name2"> Nome do Departamento</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group row mb-3">
                        <label class="col-md-7 col-form-label" for="name2">: {{$departamento->nome}}</label>
                    </div>
                </div>
            </div>
            <div id="labelespaco" class="row">
                <div class="col-5">
                    <div class="form-group row mb-3">
                        <p class="col-md-5 col-form-label" for="name2"> Chefe do Departamento</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group row mb-3">
                        <label class="col-md-7 col-form-label" for="name2">: {{$departamento->chefe_departamento}}</label>
                    </div>
                </div>
            </div>
            <div id="labelespaco" class="row">
                <div class="col-5">
                    <div class="form-group row mb-3">
                        <p class="col-md-5 col-form-label" for="name2"> Email</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group row mb-3">
                        <label class="col-md-7 col-form-label" for="name2">: {{$departamento->email}}</label>
                    </div>
                </div>
            </div>
            <div id="labelespaco" class="row">
                <div class="col-5">
                    <div class="form-group row mb-3">
                        <p class="col-md-5 col-form-label" for="name2"> Telefone</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group row mb-3">
                        <label class="col-md-7 col-form-label" for="name2">: {{$departamento->telefone}}</label>
                    </div>
                </div>
            </div>
            <div id="labelespaco" class="row">
                <div class="col-5">
                    <div class="form-group row mb-3">
                        <p class="col-md-5 col-form-label" for="name2"> Tipo</p>
                    </div>
                </div>
                <div class="col-7">
                    <div class="form-group row mb-3">
                        <label class="col-md-7 col-form-label" for="name2">: <?php if($departamento->tipo == 1) { echo 'Departamento Administrativo';} else{ echo 'Departamento Estudantil';} ?></label>
                    </div>
                </div>
            </div>
        </div>              
        <!-- Inclusão da Modal -->
        @include('includes.curso.modalCurso')
        @include('includes.curso.modalEditarCurso')
        <a id="modalEditar" style="display:none" href="#edit-modal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
            
        <?php if($departamento->tipo == 2){ ?>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="table-responsive">
                        <table class="table mb-0">
                            <thead id="cabecatabela">
                                <tr>
                                    <th style="text-align:center">#</th>
                                    <th style="text-align:center">Curso</th>
                                    <th  class="float-right"><a href="#curso-modal" class="btn btn-primary waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="mdi mdi-plus-circle mr-1"></i> Adicionar Curso</i></a></th>
                                </tr>
                            </thead>
                            <tbody  id="cursoTable">
                            
                            </tbody>
                        </table>
                        <hr>
                        <!-- $departamentos->links() -->
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div> 
</div> 
<script>
    $( "#formularioSalvar" ).validate( {
		rules: {					
			nome: {
				required: true,
			}
		},
		messages: {					
			nome: {
                required: "O nome do curso é obrigatório.",
			}
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `invalid-feedback` class to the error element
			error.addClass( "invalid-feedback" );
			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.next( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
		}
    });
    
    function carregarCursoTable(){
        var id = $('#id_departamento').val();
        $.ajax({
            url: "{{ url('pegaCursos') }}/"+id,
            success:function(data){
                $('#cursoTable').html(data);
            },
            error: function(e)
			{
				alert(e);
			}
        })
    }

    carregarCursoTable();

    $('#formularioSalvar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);

        $.ajax({
            url:"{{ url('registarCurso') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Custombox.modal.close();
                    Swal.fire({
                        text: "Curso registado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarCursoTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao registar o curso.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $('#formularioEditar').submit(function(e){
        e.preventDefault();

        var request = new FormData(this);

        $.ajax({
            url:"{{ url('editarCurso') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Curso Actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
                    carregarCursoTable();
                }            
            },
            error: function(e){
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o curso.',
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
            url: "{{ url('pegaCurso') }}/"+id,
            method: "GET",
            dataType: "JSON",
            success: function(data){                
                $('#modalEditar').click();
                $('#nome_edit').val(data.nome);
                $('#id_curso').val(data.id);
            },
            error: function(e)
            {
                
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar o curso?',
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
                        url: "{{ url('eliminarCurso') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarCursoTable();
                            Swal.fire(
                            'Eliminado!',
                            'Eliminado com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao eliminar o curso.',
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