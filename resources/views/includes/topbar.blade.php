<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados_logado'); 
?>
<header id="topnav">
    <!-- Inicio TopBar -->
    <div class="navbar-custom">
        <div class="container-fluid">
            
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Procurar...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="#" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-soft-primary text-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Doug Dukes commented on Admin Dashboard
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a> 
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ url('images/users/user.jpg') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                        {{ $dados[0]->nome }} || <?php if($dados[0]->tipo==1){echo 'Funcionário';}if($dados[0]->tipo==2){echo 'Docente';}if($dados[0]->tipo==3){echo 'Estudante';} ?> <i class="mdi mdi-chevron-down"></i><br> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Seja bem vindo !</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ url('verperfil') }}" class="dropdown-item notify-item">
                            <i class="remixicon-account-circle-line"></i>
                            <span>Meu Perfil</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a class="dropdown-item notify-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="remixicon-logout-box-line"></i>
                            <span>Sair</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>            

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ url('home') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ url('images/logo-light.png') }}" alt="" height="24">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="{{ url('images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            @can('criar_user')
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Utilizadores
                            <i class="mdi mdi-chevron-down"></i> 
                        </a>
                        <div class="dropdown-menu">
                            <!-- item-->
                            <a href="{{ url('registarUtilizador') }}" class="dropdown-item">
                                <i class="fe-user mr-1"></i>
                                <span>Criar Utilizador</span>
                            </a>
                            <!-- item-->
                            <a href="{{ url('listarUtilizadores') }}" class="dropdown-item">
                                <i class="fe-users mr-1"></i>
                                <span>Listar Utilizadores</span>
                            </a>
                            <!-- item-->
                            <a href="{{ url('pesquisarUtilizador') }}" class="dropdown-item">
                                <i class="fe-search mr-1"></i>
                                <span>Pesquisar Utilizador</span>
                            </a>
                        </div>
                    </li>
                </ul>
            @endcan

            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Fim Topbar -->
    
    <!-- Inicio MenuBar -->
    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="{{ url('home') }}">
                            <i class="remixicon-home-4-fill"></i>Inicio 
                        </a>
                    </li>

                    <!-- Inclusão da Modal -->
                    @include('includes.departamento.modalPesquisarDepartamento')
                    
                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-stack-line"></i>Gestão Departamental <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('listarDepartamentos')}}"><i class="fe-list mr-1"></i>Listar departamentos</a>
                            </li>
                            <li>
                                <a href="{{ url('pesquisarDepartamento')}}"><i class="fe-search mr-1"></i> Pesquisar Departamento</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-book-open-fill"></i>Gestão de Temas <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('listarSugestaoEstudante')}}"><i class="fe-file-text mr-1"></i>Proposta de Estudante</a>     
                            </li>
                            <li>
                                <a href="{{ url('listarSugestaoDepartamento')}}"><i class="fe-file-text mr-1"></i>Sugestão do Departamento</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-list mr-1"></i>Listar Temas<div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="admin-sweet-alert.html">Temas em Curso</a>
                                    </li>
                                    <li>
                                        <a href="admin-nestable.html">Temas Defendidos</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-bar-chart-fill"></i>Estatísticas <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#"><i class="fe-file-text mr-1"></i>Registar Tema</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-settings-3-fill"></i>Configurações <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ url('listarAreaAplicacao')}}"><i class="fe-file-text mr-1"></i>Linha de Investigação</a>
                            </li>
                            
                        </ul>
                    </li>

                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- Fim MenuBar -->
</header>