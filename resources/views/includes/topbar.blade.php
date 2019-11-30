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

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon">
                                    <img src="assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Mario Drummond</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>Hi, How are you? What about our next meeting</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon">
                                    <img src="assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" /> </div>
                                <p class="notify-details">Karen Robinson</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small>Wow ! this admin looks good and awesome design</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-soft-warning text-warning">
                                    <i class="mdi mdi-account-plus"></i>
                                </div>
                                <p class="notify-details">New user registered.
                                    <small class="text-muted">5 hours ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Caleb Flakelar commented on Admin
                                    <small class="text-muted">4 days ago</small>
                                </p>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-secondary">
                                    <i class="mdi mdi-heart"></i>
                                </div>
                                <p class="notify-details">Carlos Crouch liked
                                    <b>Admin</b>
                                    <small class="text-muted">13 days ago</small>
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
                        {{ $dados[0]->nome }} <i class="mdi mdi-chevron-down"></i> 
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
                        <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
                    </div>
                </li>
            </ul>
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
                        <a href="#">
                            <i class="remixicon-home-4-fill"></i>Inicio 
                        </a>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-stack-line"></i>Gestão Departamental <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#"><i class="fe-file-text mr-1"></i>Registar departamento</a>
                            </li>
                            <li>
                                <a href="#"><i class="fe-list mr-1"></i>Listar departamentos</a>
                            </li>
                            <li>
                                <a href="#"><i class="fe-search mr-1"></i>Pesquisar departamento</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-book-open-fill"></i>Gestão de Temas <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="#"><i class="fe-file-text mr-1"></i>Registar Tema</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-list mr-1"></i> Listar Temas <div class="arrow-down"></div></a>
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
                            <i class="remixicon-honour-line"></i>Components <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="#"><i class="fe-anchor mr-1"></i> Admin UI <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="admin-sweet-alert.html">Sweet Alert</a>
                                    </li>
                                    <li>
                                        <a href="admin-nestable.html">Nestable List</a>
                                    </li>
                                    <li>
                                        <a href="admin-treeview.html">Treeview</a>
                                    </li>
                                    <li>
                                        <a href="admin-range-slider.html">Range Slider</a>
                                    </li>
                                    <li>
                                        <a href="admin-carousel.html">Carousel</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="widgets.html"><i class="fe-aperture mr-1"></i> Widgets </a>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-bookmark mr-1"></i> Forms <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="forms-elements.html">General Elements</a>
                                    </li>
                                    <li>
                                        <a href="forms-advanced.html">Advanced</a>
                                    </li>
                                    <li>
                                        <a href="forms-validation.html">Validation</a>
                                    </li>
                                    <li>
                                        <a href="forms-pickers.html">Pickers</a>
                                    </li>
                                    <li>
                                        <a href="forms-wizard.html">Wizard</a>
                                    </li>
                                    <li>
                                        <a href="forms-summernote.html">Summernote</a>
                                    </li>
                                    <li>
                                        <a href="forms-quilljs.html">Quilljs Editor</a>
                                    </li>
                                    <li>
                                        <a href="forms-file-uploads.html">File Uploads</a>
                                    </li>
                                    <li>
                                        <a href="forms-x-editable.html">X Editable</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-grid mr-1"></i> Tables <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="tables-basic.html">Basic Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-datatables.html">Data Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-editable.html">Editable Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-tablesaw.html">Tablesaw Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-responsive.html">Responsive Tables</a>
                                    </li>
                                    <li>
                                        <a href="tables-footables.html">FooTables</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-bar-chart-2 mr-1"></i> Charts <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="charts-flot.html">Flot Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-apex.html">Apex Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-morris.html">Morris Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartjs.html">Chartjs Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-c3.html">C3 Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-peity.html">Peity Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-chartist.html">Chartist Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-sparklines.html">Sparklines Charts</a>
                                    </li>
                                    <li>
                                        <a href="charts-knob.html">Jquery Knob Charts</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-cpu mr-1"></i> Icons <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="icons-remix.html">Remix Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-feather.html">Feather Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-mdi.html">Material Design Icons</a>
                                    </li>
                                    <li>
                                        <a href="icons-font-awesome.html">Font Awesome</a>
                                    </li>
                                    <li>
                                        <a href="icons-themify.html">Themify</a>
                                    </li>
                                    <li>
                                        <a href="icons-weather.html">Weather</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="#"><i class="fe-map mr-1"></i> Maps <div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="maps-google.html">Google Maps</a>
                                    </li>
                                    <li>
                                        <a href="maps-vector.html">Vector Maps</a>
                                    </li>
                                    <li>
                                        <a href="maps-mapael.html">Mapael Maps</a>
                                    </li>
                                </ul>
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