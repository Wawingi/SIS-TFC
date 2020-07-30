

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilizadores</a></li>
                            <li class="breadcrumb-item active">Ver Perfil Utilizador</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ver Perfil Utilizador</h4>
                </div>
            </div>
        </div>
        <!-- Alerta de sucesso -->
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
        @include('includes.modalconfirma')
        @include('includes.modaladicionarperfil')
        @include('includes.perfil.modalTrocaCurso')

        
        <br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="btn-group dropdown mt-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Menu</button>
                        <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-chevron-down"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#modalConfirma"><i class="fas fa-lock mr-2"></i>Activar conta  |  <i class="fas fa-unlock mr-2"></i>Desactivar conta</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#custom-modal" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="far fa-address-card mr-2"></i>Adicionar Perfil</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="RedefinirSenha dropdown-item" idPessoa='{{$dados->pessoa_id}}' href="#" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="fas fa-user-lock mr-2"></i>Redefinir Senha</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">DADOS PESSOAIS</h4><hr>
                            <!-- Dados pessoais -->
                            <div class="row">
                                <input type="hidden" name="pessoa_id" id="pessoa_id" class="form-control" value="{{$dados->pessoa_id}}">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Nome</p>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="nome_edit" data-name="nome" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o nome">{{$dados->nome}}</a>
                                    </div>
                                </div>
                            </div>
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Data de nascimento</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="pessoa_edit" data-name="data_nascimento" data-type="combodate" data-value="{{$dados->data_nascimento}}" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="{{$dados->pessoa_id}}"  data-title="Select Date of birth"></a>      
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> BI ou Passaporte n.º</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="pessoa_edit" data-name="bi" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o nº do documento">{{$dados->bi}}</a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Género</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="genero_edit" data-name="genero" data-type="select" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o genero">@if($dados->genero==1)Masculino @else Feminino @endif</a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <hr><h4 class="header-title">DADOS PROFISSIONAIS</h4><hr>
                            <!-- Dados profissionais -->
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Faculdade</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a class="nao_edit">{{$dados->faculdade}}</a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Departamento</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        @if($dados->tipo==3 || ($dados->tipo==2 && $dados->privilegio==0))    
                                            <a class="nao_edit">{{$dados->departamento}}</a>
                                        @else
                                            @include('includes.perfil.modalTrocaDepartamento')
                                            <a href="#" class="pessoa_edit" data-backdrop="static" data-toggle="modal" data-target="#modalTrocaDepartamento">{{$dados->departamento}}</a>
                                        @endif
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <?php if($dados->tipo==1){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Função</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <a href="#" class="funcao_edit" data-name="funcao" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o nº do documento"><?php try{ echo $dados->funcao;}catch(Exception $e){} ?></a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            <?php } else if($dados->tipo==2){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Nível Académico</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <a href="#" class="nivel_edit" data-name="nivel_academico" data-type="select" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o nível">{{$dados->nivel_academico}}</a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            <?php } else if($dados->tipo==3){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Curso</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <a href="#" class="pessoa_edit" data-backdrop="static" data-toggle="modal" data-target="#modalTrocaCurso">{{$dados->curso}}</a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Número Mecanográfico</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <a href="#" class="estudante_edit" data-name="numero_mecanografico" data-type="number" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o número mecanográfico">{{$dados->numero_mecanografico}}</a>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            <?php } ?>
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Tipo de conta</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a class="nao_edit"><?php if($dados->tipo==1){echo 'Funcionário';}if($dados->tipo==2){echo 'Docente';}if($dados->tipo==3){echo 'Estudante';} ?></a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <hr><h4 class="header-title">DADOS DA CONTA</h4><hr>
                            <!-- Dados profissionais -->
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> E-mail</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="utilizador_edit" data-name="email" data-type="email" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o email">{{$dados->email}}</a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Telefone</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a href="#" class="telefone_edit" data-name="telefone" data-type="number" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o número de telefone">{{$dados->telefone}}</a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Estado</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <a class="nao_edit"><?php if($dados->estado==1){ echo 'Activo';}else{ echo 'Desactivado';} ?></a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Pefil de conta</p>
                                    </div>
                                </div> 
                            </div> 
                            <br>
                            <div id="labelespaco" class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th>Descrição</th>
                                                    <th></th>
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
            </div> 
        </div> 
        <!--Fim do conteudo-->
    </div> 
</div>
<script>
    function carregarDataTable(){
        var pessoa_id = $('#pessoa_id').val(); //id da pessoa dono da role
        $.ajax({
            url: "{{ url('pegaRoleUtilizador') }}/"+pessoa_id,
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

    $(document).on('click','.eliminar',function(e){

        Swal.fire({
			  title: 'Deseja realmente remover o perfil?',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Remover',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "{{ url('eliminarRoleUser') }}/"+id,
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

    $(document).on('click','.RedefinirSenha',function(e){
        Swal.fire({
            title: 'A senha será redefinida para padrão. Deseja continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Redefinir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                e.preventDefault();
                var id = $(this).attr('idPessoa');
                $.ajax({
                    url: "{{ url('resetarSenha') }}/"+id,
                    type: "GET",
                    success: function(data){
                        carregarDataTable();
                        Swal.fire(
                        'Redefinida!',
                        'Senha redefinida com Sucesso.',
                        'success'
                        )
                    },
                    error: function(e)
                    {
                        Swal.fire({
                            text: 'Ocorreu um erro ao redefinir senha.',
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }
                });
            }
        });
    });

    $('#formularioEditarCurso').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('editarCursoEstudante') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarClose').click();
                    Swal.fire({
                        text: "Curso actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    location.reload();
                }            
            },
            error: function(e){
                $('#modalEditarClose').click();
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar o curso.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $('#formularioEditarDepartamentoFuncionario').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $.ajax({
            url:"{{ url('editarDepartamentoFuncionario') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    $('#modalEditarDptoClose').click();
                    Swal.fire({
                        text: "Actualizado com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    }),
                    location.reload();
                }            
            },
            error: function(e){
                $('#modalEditarDptoClose').click();
                Swal.fire({
                    text: 'Ocorreu um erro ao actualizar.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
            }
        });
    });

    $(document).ready(function (){
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>',
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':'{{csrf_token()}}'
            }
        });

        $(".pessoa_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório"
            },
            url:'{{url("editarPessoa")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".nome_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/))
                    return "Nome inválido.";
            },
            url:'{{url("editarNome")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".utilizador_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório"
            },
            url:'{{url("editarUtilizador")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response, newValue){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".funcao_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório"
            },
            url:'{{url("editarFuncionario")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".telefone_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[0-9]{9}$/))
                    return "Número inválido.";
            },
            url:'{{url("editarTelefone")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".estudante_edit").editable({
            validate:function(e){
                if(""==$.trim(e))
                    return "Este campo é de preenchimento obrigatório";
                if(!e.match(/^[0-9]*$/))
                    return "Formato inválido."
            },
            url:'{{url("editarEstudante")}}',
            mode:"inline",
            inputclass:"form-control-sm",
            success: function(response){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        $(".genero_edit").editable({
            mode:"inline",
            inputclass:"form-control-sm",
            source:[{value:1,text:"Masculino"},{value:2,text:"Feminino"}],
            display:function(t,e){
                var n=$.grep(e,function(e){return e.value==t});
                n.length?$(this).text(n[0].text):$(this).empty()
            },
            url:'{{url("editarPessoa")}}',
            success: function(response){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });

        
    });

    $(document).ready(function (){
        $.fn.editableform.buttons='<button type="submit" class="btn btn-primary editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button><button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect"><i class="mdi mdi-close"></i></button>',
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':'{{csrf_token()}}'
            }
        });

        $(".nivel_edit").editable({
            mode:"inline",
            inputclass:"form-control-sm",
            source:[{value:"Professor Assistente Estagiário",text:"Professor Assistente Estagiário"},{value:"Professor Assistente",text:"Professor Assistente"},{value:"Professor Auxiliar",text:"Professor Auxiliar"},{value:"Professor Titular",text:"Professor Titular"}],
            display:function(t,e){
                var n=$.grep(e,function(e){return e.value==t});n.length?$(this).text(n[0].text):$(this).empty()
            },
            url:'{{url("editarNivelAcademico")}}',
            success: function(response){
                if(response=='sucesso'){
                    Swal.fire({
                        text: 'Actualizado com sucesso.',
                        icon: 'success',
                        confirmButtonText: 'Fechar'
                    })
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao actualizar.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            }
        });
    });
    
</script>    
@stop