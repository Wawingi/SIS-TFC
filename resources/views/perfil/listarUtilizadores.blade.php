
@extends('layouts.inicio')
@section('content')
<?php 
    //sessão dos dados do utilizador logado
    $sessao=session('dados_logado'); 
?>
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
                            <li class="breadcrumb-item active">Listar utilizadores</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->
        <!--listagem do funcionario-->   
        <br><br>
        <?php if($sessao[0]->tipo==1){ ?>    
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <a href='{{ url("registarUtilizador")}}' class="btn btn-outline-secondary waves-effect waves-light" data-overlayColor="#38414a"><i class="fas fa-user-plus mr-1"></i> Registar Utilizador</a></h4><br>
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR FUNCIONÁRIOS</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR CHEFES DE DEPARTAMENTO</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Listagem de docentes-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            @foreach($dados as $dado)
                                            <div class="col-lg-4">
                                                <div id="card-view" class="text-center card-box ribbon-box">
                                                    <div class="clearfix"></div>
                                                    <div class="pt-2 pb-2">
                                                        <img src="{{ asset('images/users/user.jpg')}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                                                        <h4 class="mt-3 font-17">{{$dado->nome}}</h4>
                                                        <p class="text-muted"><?php try{ echo $dado->funcao; }Catch(Exception $e){} ?> <span> </p>
                                                        <p class="text-muted"><span>{{$dado->bi}}</span></p>
                                                        <hr>
                                                        <a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}' class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-account-badge-horizontal mr-1"></i> Ver Perfil</a>
                                                        <a href="" class="btn btn-danger btn-sm waves-effect"><i class=" mdi mdi-delete-forever mr-1"></i> Eliminar Conta</a>
                                                    </div> <!-- end .padding -->
                                                </div> <!-- end card-box-->
                                            </div>
                                            @endforeach   
                                        </div> 
                                        {{ $dados->links() }}
                                    </div>
                                    <!-- Listagem de estudantes-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            @foreach($dadosChefeDepartamento as $dado)
                                            <div class="col-lg-4">
                                                <div id="card-view" class="text-center card-box ribbon-box">
                                                    <div class="clearfix"></div>
                                                    <div class="pt-2 pb-2">
                                                        <img src="{{ asset('images/users/user.jpg')}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                                                        <h4 class="mt-3 font-17">{{$dado->nome}}</h4>
                                                        <p class="text-muted"><?php try{ echo $dado->funcao; }Catch(Exception $e){} ?> <span> </p>
                                                        <p class="text-muted"><span>{{$dado->departamento}}</span></p>
                                                        <hr>
                                                        <a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}' class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-account-badge-horizontal mr-1"></i> Ver Perfil</a>
                                                        <a href="" class="btn btn-danger btn-sm waves-effect"><i class=" mdi mdi-delete-forever mr-1"></i> Eliminar Conta</a>
                                                    </div> <!-- end .padding -->
                                                </div> <!-- end card-box-->
                                            </div>
                                            @endforeach      
                                        </div> 
                                        {{ $dados->links() }}                          
                                    </div>
                                    <div class="clearfix"></div>
                                </div> <!-- tab-content -->
                            </div> <!-- end #btnwizard-->
                        </div> <!-- end card-body -->
                    </div>
                </div>
            </div>
        <?php }else{ ?> 
        <!--Fim do conteudo-->
        <!--Inicio do conteudo docente e estudante-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <a href='{{ url("registarUtilizador")}}' class="btn btn-outline-secondary waves-effect waves-light" data-overlayColor="#38414a"><i class="fas fa-user-plus mr-1"></i> Registar Utilizador</a></h4><br>
                        <div class="card-body">
                            <div id="btnwizard">
                                <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                    <li class="nav-item">
                                        <a href="#tab12" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR DOCENTES</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#tab22" data-toggle="tab" class="nav-link pt-2 pb-2">
                                            <i class="mdi mdi-account-group mdi-18px mr-1"></i>
                                            <span class="d-none d-sm-inline">LISTAR ESTUDANTES</span>
                                        </a>
                                    </li>
                                </ul>
                                <hr>            
                                <div class="tab-content mb-0 b-0">
                                    <!-- Listagem de docentes-->
                                    <div class="tab-pane fade" id="tab12">
                                        <div class="row">
                                            @foreach($dados as $dado)
                                            <div class="col-lg-4">
                                                <div id="card-view" class="text-center card-box ribbon-box">
                                                    <div class="clearfix"></div>
                                                    <div class="pt-2 pb-2">
                                                        <img src="{{ asset('images/users/user.jpg')}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                                                        <h4 class="mt-3 font-17">{{$dado->nome}}</h4>
                                                        <p class="text-muted"><?php try{ echo $dado->funcao; }Catch(Exception $e){} ?> <span> </p>
                                                        <p class="text-muted"><span>{{$dado->bi}}</span></p>
                                                        <hr>
                                                        <a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)) }}' class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-account-badge-horizontal mr-1"></i> Ver Perfil</a>
                                                        <a href="" class="btn btn-danger btn-sm waves-effect"><i class=" mdi mdi-delete-forever mr-1"></i> Eliminar Conta</a>
                                                    </div> <!-- end .padding -->
                                                </div> <!-- end card-box-->
                                            </div>
                                            @endforeach      
                                        </div> 
                                        {{ $dados->links() }}
                                    </div>
                                    <!-- Listagem de estudantes-->                                
                                    <div class="tab-pane fade" id="tab22">
                                        <div class="row">
                                            @foreach($dadosEstudante as $dado)
                                                <div class="col-lg-4">
                                                    <div id="card-view" class="text-center card-box ribbon-box">                 
                                                        <div class="clearfix"></div>
                                                        <div class="pt-2 pb-2">
                                                            <img src="{{ asset('images/users/user.jpg')}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                                                            <h4 class="mt-3 font-17">{{$dado->nome}}</h4>
                                                            <p class="text-muted"><?php try{ echo $dado->funcao; }Catch(Exception $e){} ?> <span> </p>
                                                            <p class="text-muted"><span>{{$dado->bi}}</span></p>
                                                            <hr>
                                                            <a href='{{ url("verperfilUtilizador/".base64_encode($dado->id)."/".base64_encode($dado->tipo)) }}' class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-account-badge-horizontal mr-1"></i> Ver Perfil</a>
                                                            <a href="" class="btn btn-danger btn-sm waves-effect"><i class=" mdi mdi-delete-forever mr-1"></i> Eliminar Conta</a>
                                                        </div> <!-- end .padding -->
                                                    </div> <!-- end card-box-->
                                                </div>
                                            @endforeach 
                                        </div>
                                        {{ $dadosEstudante->links() }}                         
                                    </div>

                                    <div class="clearfix"></div>
                                </div> <!-- tab-content -->
                            </div> <!-- end #btnwizard-->
                        </div> <!-- end card-body -->
                    </div>
                </div>
            </div>
        <?php } ?>     
    </div> 
</div>
@stop