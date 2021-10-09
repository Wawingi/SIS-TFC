<!-- Ver meu perfil quando estou logado -->
<?php 
    //sessão dos dados do utilizador logado
    //$dados=session('dados_logado');
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
                                                <a href="#" class="nome_edit" data-name="nome" data-type="text" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o nome">{{$dados->nome}}</a>
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
                                                <a class="nao_edit">{{$dados->bi}}</a>
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
                                                <a class="nao_edit">{{$dados->faculdade}}</a>
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
                                                <a class="nao_edit"><?php try{ echo $dados->departamento; }Catch(Exception $e){} ?></a>
                                            </div>
                                        </div>                                   
                                    </div>
                                    <?php if($dados->tipo==3){ ?>                    
                                        <div id="labelespaco" class="row">                                           
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Curso</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <a class="nao_edit"><?php try{ echo $dados->curso; }Catch(Exception $e){} ?></a>
                                                </div>
                                            </div>        
                                        </div>
                                    <?php } ?>
                                    
                                    <div id="labelespaco" class="row">                                 
                                        <?php if($dados->tipo==1){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Função</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <a class="nao_edit"><?php try{ echo $dados->funcao; }Catch(Exception $e){} ?></a>
                                                </div>
                                            </div>
                                        <?php } else if($dados->tipo==2){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Nível Acadêmico</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <a class="nao_edit"><?php try{ echo $dados->nivel_academico; }Catch(Exception $e){} ?></a>
                                                </div>
                                            </div>        
                                        <?php } else if($dados->tipo==3){ ?>
                                            <div class="col-5">
                                                <div class="form-group row mb-3">
                                                    <p class="col-md-5 col-form-label"> Número Mecanográfico</p>
                                                </div>
                                            </div>     
                                            <div class="col-7">
                                                <div class="form-group row mb-3">
                                                    <a class="nao_edit"><?php try{ echo $dados->numero_mecanografico; }Catch(Exception $e){} ?></a>
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
                                                <a class="nao_edit">{{$dados->email}}</a>
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
                                                <a href="#" class="telefone_edit" data-name="telefone" data-type="number" data-placeholder="Preenchimento obrigatório" data-pk="{{$dados->pessoa_id}}" data-title="Informe o número de telefone">{{$dados->telefone}}</a>
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
                                                <a class="nao_edit">     
                                                   @for($i=0; $i<count($roles); $i++)
                                                        {{$roles[$i]->nome}} @if($i+1!=count($roles))|@endif
                                                   @endfor
                                                </a>
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
                                                <a href="#" class="btn btn-sm btn-warning btn-rounded waves-effect waves-light btn-rounded" data-toggle="modal" data-target="#modalAlterar" data-backdrop="static" data-keyboard="false"><i class="fas fa-user-lock mr-1"></i>Alterar Senha</a> 
                                            </div>
                                        </div> 
                                    </div>                                   
                                </div>                      
                                <div class="clearfix"></div>
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
                        $('#modalCloseAlterar').click();
                        Swal.fire({
                            text: "Senha alterada com sucesso.",
                            icon: 'success',
                            confirmButtonText: 'Fechar',
                            timer: 1500
                        }),
                        $('#trocarSenha')[0].reset();
                    }else{
                        $('#modalCloseAlterar').click();
                        $('#trocarSenha')[0].reset();
                        Swal.fire({
                            text: 'Ocorreu um erro ao alterar a senha.',
                            icon: 'error',
                            confirmButtonText: 'Fechar'
                        })
                    }            
                },
                error: function(e){
                    $('#modalCloseAlterar').click();
                    $('#trocarSenha')[0].reset();
                    Swal.fire({
                        text: 'Ocorreu um erro ao alterar a senha.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                }
            });
        }else{
            $('#trocarSenha')[0].reset();
            Swal.fire({
                text: 'A nova senha e a senha de confirmação devem ser iguais.',
                icon: 'error',
                confirmButtonText: 'Fechar'
            }),
            $('#modalCloseAlterar').click();
        }
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

</script>
@stop