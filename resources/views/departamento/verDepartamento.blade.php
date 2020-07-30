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
                    <h4 class="page-title">Ver Departamento</h4>
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
                    @if($chefe_departamento==null)
                        <div class="form-group row mb-3">
                            <label style="color:#3bafda" class="col-md-7 col-form-label">: Departamento sem Chefe</label>
                        </div>
                    @else
                        <div class="form-group row mb-3">
                            <label class="col-md-7 col-form-label" for="name2">: {{$chefe_departamento}}</label>
                        </div>
                    @endif
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
        @include('includes.curso.modalEditarCurso')

        <a id="modalEditar" style="display:none" href="#edit-modal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
            
        <?php if($departamento->tipo == 2){ ?>
            <div class="card-box">
                <div class="row">                            
                    <div class="col-4">
                        <div class="card-box">
                            <form id="formularioSalvar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Curso</label>
                                    <input required type="text" class="form-control" name="nome" placeholder="ex: Ciências da Computação">
                                </div>  
                                <input type="hidden" class="form-control" value="{{$departamento->id}}" id="id_departamento" name="id_departamento">                         
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
                                        <th class="text-center">#</th>
                                        <th>Curso</th>
                                        <th style="width:15%">Acções</th>
                                    </tr>
                                </thead>
                                <tbody id="cursoTable">
                                                                                             
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
                                                        <i class="far fa-trash-alt mr-1 AcordeonLixeira"></i><h7 class="AcordeonLixeira">Cursos Eliminados</h7>
                                                    </a>
                                                </h2>
                                            </div>
                                            <br>                                            
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">                                              
                                                <table id="paginationFullNumbers2" class="table table-bordered" width="100%">
                                                    <thead id="cabecatabela">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Curso</th>
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
        <?php } ?>
    </div> 
</div> 
<script>
    $( "#formularioSalvarr" ).validate( {
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
        var isDeleted=0;
        $.ajax({
            url: "{{ url('pegaCursos') }}/"+id+"/"+isDeleted,
            success:function(data){
                $('#cursoTable').html(data);
                $('#paginationFullNumbers').DataTable({
                    "pagingType": "full_numbers"
                }); 
            },
            error: function(e)
			{
				alert(e);
			}
        })
    }
    carregarCursoTable();

    function carregarCursoTableLixeira(){
        var id = $('#id_departamento').val();
        var isDeleted=1;
        $.ajax({
            url: "{{ url('pegaCursos') }}/"+id+"/"+isDeleted,
            success:function(data){
                $('#dataTableLixeira').html(data);
                $('#paginationFullNumbers2').DataTable({
                    "pagingType": "full_numbers"
                }); 
            },
            error: function(e)
			{
				alert(e);
			}
        })
    }
    carregarCursoTableLixeira();

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

    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
                    
        $('#modalEditar').click();
        $('#nome_edit').val(nome);
        $('#id_curso').val(id);
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
                    $('#formularioEditar')[0].reset();
                    carregarCursoTable();
                }            
            },
            error: function(e){
                $('#modalEditarClose').click();
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o curso.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                }),
                $('#formularioEditar')[0].reset();
            }
        });
    });

    $(document).on('click','.eliminar',function(e){
        Swal.fire({
			  title: 'Deseja realmente eliminar o curso? Poderá restaurá-lo.',
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
                            carregarCursoTableLixeira();
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


    $(document).on('click','.restaurar',function(e){
        Swal.fire({
			  title: 'Deseja recuperar o curso?',
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
                        url: "{{ url('restaurarCurso') }}/"+id,
                        type: "GET",
                        success: function(data){
                            Swal.fire(
                                'Recuperado!',
                                'Recuperado com Sucesso.',
                                'success'
                            ),
                            carregarCursoTable();
                            carregarDataTableLixeira();
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao recuperar o curso.',
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