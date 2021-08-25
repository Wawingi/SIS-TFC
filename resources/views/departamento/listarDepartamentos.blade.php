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
                    <h4 class="page-title">Listar Departamentos</h4>
                </div>
            </div>
        </div>
        
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
            <!-- Inclusão da Modal -->
            @include('includes.departamento.modalEditarDepartamento')
            <a id="modalEditar" style="display:none" href="#edit-modal" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".bs-example-modal-lg"></a>
            
            <div class="card-box">
                <div class="row">                            
                    <div class="col-4">
                        <div class="card-box">
                            <form id="formularioSalvar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Departamento</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="ex: Ciências da Computação">
                                </div>
                                <div class="form-group">
                                    <label for="company">E-mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="Informe o email">
                                </div>
                                      
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="number" class="form-control" name="telefone" placeholder="Informe o contacto telefónico" min="0">
									<span class="tlf" style="color:red"></span>
								</div>
                                          
                                <div class="form-group mb-3">
                                    <label for="genero">Tipo</label><br>
                                    <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                        <input type="radio" value="1" name="tipo" checked>
                                        <label for="tipo"> Administrativo </label>
                                    </div>
                                    <div class="radio form-check-inline">
                                        <input type="radio" value="2" name="tipo" checked>
                                        <label for="tipo"> Estudantil </label>
                                    </div>
                                </div>  
								
                                <input type="hidden" class="form-control" value="{{$sessao[0]->id_faculdade}}" name="id_faculdade">
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
                                        <th>Departamento</th>
                                        <th>Email</th>
                                        <th style="width:15%">Acções</th>
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
                                                        <i class="far fa-trash-alt mr-1 AcordeonLixeira"></i><h7 class="AcordeonLixeira">Departamentos Eliminado</h7>
                                                    </a>
                                                </h2>
                                            </div>
                                            <br>                                            
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">                                              
                                                <table id="paginationFullNumbers2" class="table table-bordered" width="100%">
                                                    <thead id="cabecatabela">
                                                        <tr>
                                                            <th>Departamento</th>
                                                            <th>Email</th>
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
    </div> 
</div>

<script>
		
    function carregarDataTable(){
        var isDeleted=0;
        $.ajax({
            url: "{{ url('pegaDepartamentos') }}/"+isDeleted,
            success:function(data){
                $('#dataTable').html(data);
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
    carregarDataTable();

    function carregarDataTableLixeira(){
        var isDeleted=1;
        $.ajax({
            url: "{{ url('pegaDepartamentos') }}/"+isDeleted,
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
    carregarDataTableLixeira();

    $("#formularioSalvar").validate({
        rules: {					
            nome: {
                required: true,
                pattern: /^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/
            },
            email: {
                required: true
            },
            telefone: {
                required: true
            }
        },
        messages: {					
            nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
            },
            email: {
                required: "O email deve ser fornecido"
            },
            telefone: {
                required: "O número do telefone deve ser fornecido"
            }                
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioSalvar,e){  
			var id = $('#nome').val();
			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('registarDepartamento') }}",
                method: "POST",
                data: $("#formularioSalvar").serialize(),
                success:function(data){
                    if(data == "Sucesso"){
                        Swal.fire({
                            text: "Departamento registado com sucesso.",
                            icon: 'success',
                            confirmButtonText: 'Fechar'
                        })
						
						//id = $('#nome').val('');
						
                        //$('#formularioSalvar')[0].reset();
						//this.$nextTick(() => { $('#formularioSalvar')[0].reset(); });  
                        //location.reload();
                        //return false;
                        //carregarDataTable();
                    }         
                },
                error: function(response){
					var erro='';
					if( response.status === 422 ) {
						$.each(response.responseJSON.errors,function(field_name,error){
							console.log("CAMPO: "+field_name+"ERRO: "+error);							
							erro = error+' | '+erro
						})
						
						console.log('ERROS: '+erro);
						
						Swal.fire({
							text: erro,
							icon: 'error',
							confirmButtonText: 'Fechar'
						})
					}else{
						Swal.fire({
							text: 'Ocorreu um erro ao registar o departamento.',
							icon: 'error',
							confirmButtonText: 'Fechar'
						})
					}
                }
            });
        }            
    });

    $(document).on('click','.pegar',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var nome = $(this).attr('nome');
        var email = $(this).attr('email');
        var telefone = $(this).attr('telefone');
        var tipo = $(this).attr('tipo');

        $('.editar').modal('show');

        $('#nome_edit').val(nome);
        $('#email').val(email);
        $('#telefone').val(telefone);
        $('#id_departamento').val(id);

        if(tipo==1)
            document.formularioEditar.tipo[0].checked=true;
        else if(tipo==2)
            document.formularioEditar.tipo[1].checked=true;
    });

    //Editar o Departamento
    $("#formularioEditar").validate({
        rules: {					
            nome_edit: {
                required: true,
                pattern: /^[a-zA-ZâêôûáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/
            },
            email: {
                required: true
            },
            telefone: {
                required: true
            }
        },
        messages: {					
            nome_edit: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
            },
            email: {
                required: "O email deve ser fornecido"
            },
            telefone: {
                required: "O número do telefone deve ser fornecido"
            }                
        },
        
        //errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the invalid-feedback` class to the error element
            //error.addClass( "invalid-feedback" );
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
        },
        
        submitHandler: function(formularioSalvar,e){  
			var id = $('#nome').val();
			
            e.preventDefault();
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':'<?php echo csrf_token() ?>'
                },
                url:"{{ url('editarDepartamento') }}",
                method: "POST",
                data: $("#formularioEditar").serialize(),
                success:function(data){
                    if(data == "Sucesso"){
                        $('#modalEditarClose').click();
                        Swal.fire({
                            text: "Departamento actualizado com sucesso.",
                            icon: 'success',
                            confirmButtonText: 'Fechar'
                        }),

                        carregarDataTable();
						
						//id = $('#nome').val('');
						
                        //$('#formularioSalvar')[0].reset();
						//this.$nextTick(() => { $('#formularioSalvar')[0].reset(); });  
                        //location.reload();
                        //return false;
                        //carregarDataTable();
                    }         
                },
                error: function(response){
					var erro='';
					if( response.status === 422 ) {
						$.each(response.responseJSON.errors,function(field_name,error){
							console.log("CAMPO: "+field_name+"ERRO: "+error);							
							erro = error+' | '+erro
						})
						
						console.log('ERROS: '+erro);
						
						Swal.fire({
							text: erro,
							icon: 'error',
							confirmButtonText: 'Fechar'
						})
					}else{
						Swal.fire({
							text: 'Ocorreu um erro ao actualizar o departamento.',
							icon: 'error',
							confirmButtonText: 'Fechar'
						})
					}
                }
            });
        }            
    });

    $('#formularioEditarrr').submit(function(e){
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
                }else{
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar o departamento, verifique os dados e tente novamente.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    }),
                    $('#formularioSalvar')[0].reset();
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
			  title: 'Deseja realmente eliminar o departamento? Poderá recuperá-lo.',
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
			  title: 'Deseja restaurar o departamento?',
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
                        url: "{{ url('restaurarDepartamento') }}/"+id,
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
                                text: 'Ocorreu um erro ao restaurar o departamento.',
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