
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
        <!-- Importação da Modal Confirmação -->
        @include('includes.modalconfirma')
        <!-- Inclusão da Moda atribuir perfil -->
        @include('includes.modaladicionarperfil')
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
                            <a class="dropdown-item" href='{{ url("pegaUtilizador/".base64_encode($dados[0]->pessoa_id)."/".base64_encode($dados[0]->tipo))}}'><i class="fas fa-edit mr-2"></i>Editar perfil</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#custom-modal" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="far fa-address-card mr-2"></i>Adicionar Perfil</a>
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
                                <input type="hidden" name="pessoa_id" id="pessoa_id" class="form-control" value="{{$dados[0]->pessoa_id}}">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Nome</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->nome}}</label>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                            <div id="labelespaco" class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-3">
                                        <p class="col-md-5 col-form-label" for="name2"> Data de nascimento</p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-7">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->data_nascimento}}</label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->bi}}</label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: <?php if($dados[0]->genero==1){echo 'Masculino';}if($dados[0]->genero==2){echo 'Feminino';} ?></label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->faculdade}}</label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->departamento}}</label>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                            <?php if($dados[0]->tipo==1){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Função</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: <?php try{ echo $dados[0]->funcao;}catch(Exception $e){} ?></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            <?php } else if($dados[0]->tipo==2){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Nível Académico</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: <?php try{ echo $dados[0]->nivel_academico;}catch(Exception $e){} ?></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                            <?php } else if($dados[0]->tipo==3){ ?>
                                <div id="labelespaco" class="row">
                                    <div class="col-5">
                                        <div class="form-group row mb-3">
                                            <p class="col-md-5 col-form-label" for="name2"> Curso</p>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-7">
                                        <div class="form-group row mb-3">
                                            <label class="col-md-7 col-form-label" for="name2">: <?php try{ echo $dados[0]->curso;}catch(Exception $e){} ?></label>
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
                                            <label class="col-md-7 col-form-label" for="name2">: <?php try{ echo $dados[0]->numero_mecanografico;}catch(Exception $e){} ?></label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: <?php if($dados[0]->tipo==1){echo 'Funcionário';}if($dados[0]->tipo==2){echo 'Docente';}if($dados[0]->tipo==3){echo 'Estudante';} ?></label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->email}}</label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: {{$dados[0]->telefone}}</label>
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
                                        <label class="col-md-7 col-form-label" for="name2">: <?php if($dados[0]->estado==1){ echo 'Activo';}else{ echo 'Desactivado';} ?></label>
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
</script>    
@stop