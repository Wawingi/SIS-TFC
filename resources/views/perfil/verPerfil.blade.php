<!-- Ver meu perfil quando estou logado -->
<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados_logado'); 
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
                            <li class="breadcrumb-item active">Meu Perfil</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Meu perfil</h4>
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
        <br><br>

        <!-- Inclusão da Modal -->
        @include('includes.perfil.modalTrocarSenha')
        
        <!--Inicio do conteudo-->
        <div class="row">    
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div id="btnwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                <li class="nav-item">
                                    <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                        <i class="mdi mdi-account-circle mr-1"></i>
                                        <span class="d-none d-sm-inline">Dados Pessoais</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                        <i class="mdi mdi-settings mr-1"></i>
                                        <span class="d-none d-sm-inline">Dados Acadêmicos</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab32" data-toggle="tab" class="nav-link pt-2 pb-2">
                                        <i class="mdi mdi-account-badge-horizontal mr-1"></i>
                                        <span class="d-none d-sm-inline">Dados da Conta</span>
                                    </a>
                                </li>
                            </ul>
                            <hr>
                            <!-- Primeira ABA -->            
                            <div class="tab-content mb-0 b-0">

                                <div class="tab-pane fade" id="tab12">
                                    <div class="row">
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
                                    </div> <!-- end row -->
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
                                </div>
                                
                                <!-- Segunda ABA -->  
                                <div class="tab-pane fade" id="tab22">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> Faculdade</p>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-7 col-form-label">: {{$dados[0]->faculdade}}</label>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div id="labelespaco" class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> Departamento</p>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-7 col-form-label">: <?php try{ echo $dados[0]->departamento; }Catch(Exception $e){} ?></label>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <?php if($dados[0]->tipo==3){ ?>                    
                                        <div id="labelespaco" class="row">                                           
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Curso</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-7 col-form-label">: <?php try{ echo $dados[0]->curso; }Catch(Exception $e){} ?></label>
                                                </div>
                                            </div>        
                                        </div>
                                    <?php } ?>
                                    
                                    <div id="labelespaco" class="row">                                 
                                        <?php if($dados[0]->tipo==1){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Função</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-7 col-form-label">: <?php try{ echo $dados[0]->funcao; }Catch(Exception $e){} ?></label>
                                                </div>
                                            </div>
                                        <?php } else if($dados[0]->tipo==2){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Nível Acadêmico</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-7 col-form-label">: <?php try{ echo $dados[0]->nivel_academico; }Catch(Exception $e){} ?></label>
                                                </div>
                                            </div>        
                                        <?php } else if($dados[0]->tipo==3){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Número Mecanográfico</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <label class="col-md-7 col-form-label">: <?php try{ echo $dados[0]->numero_mecanografico; }Catch(Exception $e){} ?></label>
                                                </div>
                                            </div>        
                                        <?php } ?>
                                    </div>                                    
                                </div>                               

                                <!-- Terceira ABA -->
                                <div class="tab-pane fade" id="tab32">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> E-mail</p>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-7 col-form-label">: {{$dados[0]->email}}</label>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div id="labelespaco" class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> Telefone</p>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-7 col-form-label">: {{$dados[0]->telefone}}</label>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <div id="labelespaco" class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> Pefil de conta</p>
                                            </div>
                                        </div> <!-- end col -->
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label style="color:#3bafda" class="col-md-7 col-form-label">: 
                                                   @foreach($roles as $role)
                                                        {{$role->nome}} | 
                                                   @endforeach
                                                </label>
                                            </div>
                                        </div> 
                                    </div> 
                                    <div id="labelespaco" class="row">
                                        <div class="col-5">
                                            <div class="form-group row mb-3">
                                                <p class="col-md-5 col-form-label"> Alterar Senha</p>
                                            </div>
                                        </div> 
                                        <div class="col-7">
                                            <div class="form-group row mb-3">
                                                <label class="col-md-7 col-form-label">: 
                                                    <a href="#save-modal" class="btn btn-warning btn-rounded btn-sm waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlayColor="#38414a"><i class="fas fa-user-lock mr-1"></i>Alterar Senha</a>
                                                </label>
                                            </div>
                                        </div> 
                                    </div>                                   
                                </div>                      
                                <div class="clearfix"></div>
                            </div>
                        </div> 
                        <!--<a href='{{ url("pegaUtilizador/".base64_encode($dados[0]->id_pessoa)."/".base64_encode($dados[0]->tipo))}}' class="btn btn-warning waves-effect waves-light"><i class="fas fa-user-edit mr-1"></i>Editar</a>-->
                    </div> 
                </div>
            </div>
        </div>
        <!--Fim do conteudo-->
    </div> 
</div>
<script>
    $('#trocarSenha').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        if($('#novasenha').val() === $('#confirmarsenha').val()){       
            $.ajax({
                url:"{{ url('trocarSenha') }}",
                method: "POST",
                data: request,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    if(data == "Sucesso"){            
                        Custombox.modal.close();
                        Swal.fire({
                            text: "Senha alterada com sucesso.",
                            icon: 'success',
                            confirmButtonText: 'Fechar',
                            timer: 1500
                        }),
                        $('#formularioSalvar')[0].reset();
                    }            
                },
                error: function(e){
                    $('#trocarSenha')[0].reset();
                    Custombox.modal.close();
                    Swal.fire({
                        text: 'Ocorreu um erro ao alterar a senha.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            });
        }else{
            $('#trocarSenha')[0].reset();
            Custombox.modal.close();
            Swal.fire({
                text: 'A nova senha e a senha de confirmação devem ser iguais.',
                icon: 'error',
                confirmButtonText: 'Fechar'
            })
        }
    });
</script>
@stop