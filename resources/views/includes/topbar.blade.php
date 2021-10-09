<header id="topnav">
    <!-- Inicio TopBar -->
    <div class="navbar-custom">
        <div class="container-fluid">

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ url('home') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ url('images/logo.png') }}" alt="" height="44">
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <img src="{{ url('images/logo.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

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

                @can('visualizar_tutorandos')
                    <!-- tutorandos de um orientador -->
                    <li class="dropdown notification-list">
                        <a title="Solicitação de Proposta e Sugestão" class="nav-link dropdown-toggle  waves-effect waves-light" href='{{ url("minhasPropostas")}}'>
                            <i class="fas fa-user-graduate noti-icon"></i>
                            <span id="qtdTutorandos" class="badge badge-danger rounded-circle noti-icon-badge"></span>
                        </a>
                    </li>
                @endcan

                @can('visualizar_convite')
                    <!-- verificar se o estudante foi escolhido numa sugestão -->
                    <?php
                        $jaSugestao = App\Model\Pessoa::verificarEnvolvimentoSugestao($sessao[0]->id_pessoa, 0);
                    ?>
                    @if(count($jaSugestao) > 0)
                        <li class="dropdown notification-list">
                        <!--<a title="Convite para trabalhar no tema" class="nav-link dropdown-toggle  waves-effect waves-light" href='{{ url("verSugestao/".base64_encode($jaSugestao[0]->id_sugestao)."/".base64_encode(1)) }}'>-->
                            <a title="Convite para trabalhar no tema" class="nav-link dropdown-toggle  waves-effect waves-light" href='{{ url("listarConvitesSugestao") }}'>
                                <i class=" fas fa-book-reader noti-icon"></i>
                                <span class="badge badge-danger rounded-circle noti-icon-badge">{{count($jaSugestao)}}</span>
                            </a>
                        </li>
                    @else
                        <li class="dropdown notification-list">
                            <a title="Convite para trabalhar no tema" class="nav-link dropdown-toggle  waves-effect waves-light" href='#'>
                                <i class=" fas fa-book-reader noti-icon"></i>
                            </a>
                        </li>
                    @endif
                @endcan

                <li id="notificacaoTable" class="dropdown notification-list">
                    <!--Notificações serão exibidas aqui-->
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ url('images/users/user.jpg') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ml-1">
                        {{ $sessao[0]->nome }} || <?php if ($sessao[0]->tipo == 1) {echo 'Funcionário';}if ($sessao[0]->tipo == 2) {echo 'Docente';}if ($sessao[0]->tipo == 3) {echo 'Estudante';}?> <i class="mdi mdi-chevron-down"></i><br>
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

                    @can('visualizar_departamento')
                        <li class="has-submenu">
                            <a href="#">
                                <i class="remixicon-stack-line"></i>Gestão Departamental <div class="arrow-down"></div>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="{{ url('listarDepartamentos')}}"><i class="fe-list mr-1"></i>Listar departamentos</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('visualizar_proposta')
                        <li class="has-submenu">
                            <a href="#">
                                <i class="remixicon-book-open-fill"></i>Propostas & Sugestões <div class="arrow-down"></div>
                            </a>
                            <ul class="submenu">
                                <li>
                                    <a href="{{ url('listarSugestaoEstudante')}}"><i class="fe-file-text mr-1"></i>Proposta de Estudante</a>
                                </li>
                                <li>
                                    <a href="{{ url('listarSugestaoDepartamento')}}"><i class="fe-file-text mr-1"></i>Sugestão do Departamento</a>
                                </li>
                                @can('visualizar_minha_prop_sug')
                                    <li>
                                        <a href="{{ url('minhasPropostas')}}"><i class="fas fa-user-graduate noti-icon mr-1"></i>Minhas Propostas & Sugestões</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-book-2-fill"></i>Gestão de Trabalhos <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li class="has-submenu">
                                <a href="#"><i class="fe-list mr-1"></i>Listar Trabalhos<div class="arrow-down"></div></a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{url('trabalhoEmCurso')}}">Trabalhos em Curso</a>
                                    </li>
                                    <li>
                                        <a href="{{url('trabalhoDefendido')}}">Trabalhos Defendidos</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('verMeuTrabalho') }}"><i class="fe-file-text mr-1"></i>Meu Trabalho</a>
                            </li>
                            <li>
                                <a href="{{ url('meusTutorandos') }}"><i class="fas fa-user-graduate noti-icon mr-1"></i>Meus Tutorandos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-bar-chart-fill"></i>Relatórios <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{url('listarOrientadores')}}"><i class="fe-file-text mr-1"></i>Orientadores Envolvidos</a>
                            </li>
                            <li>
                                <a href="{{url('listarEditais')}}"><i class="fe-file-text mr-1"></i>Listar Editais</a>
                            </li>
                            <li>
                                <a href="{{url('listarProvasPublica')}}"><i class="fe-file-text mr-1"></i>Listar Provas Pública</a>
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
                            <li>
                                <a href="{{ url('listarPerfilUtilizador')}}"><i class="fas fa-users-cog mr-1"></i>Perfil de Utilizador</a>
                            </li>
                            <li>
                                <a href="{{ url('listarPredefinidoAvaliacao')}}"><i class="fas fa-users-cog mr-1"></i>Avalições Predefinidas</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu float-right">
                        <a href="#" onclick="window.history.back();">
                            <i class="fas fa-arrow-left"></i>Voltar
                        </a>
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
<script>
    function contTutorandos(){
        $.ajax({
            url: "{{ url('contSugestoesOrientador') }}",
            success:function(data){
                $('#qtdTutorandos').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados");
			}
        })
    }
    contTutorandos();

    function carregarDataTableNotificacao(){
        $.ajax({
            url: "{{ url('pegaNotificacoes') }}",
            success:function(data){
                $('#notificacaoTable').html(data);
            },
            error: function(e)
			{
				alert("erro ao carregar dados");
			}
        })
    }
    carregarDataTableNotificacao();
</script>