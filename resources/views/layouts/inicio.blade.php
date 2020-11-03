<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SIS-TFC</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/datatables2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('libs/custombox/custombox.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('libs/switchery/switchery.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('libs/x-editable/bootstrap-editable.css') }}" rel="stylesheet" />
        <link href="{{ asset('libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    </head>
    <body>
        <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/additional-methods.js') }}"></script>
        <script src="{{ asset('js/datatables2.min.js') }}" defer></script>
        <script src="{{ asset('js/select2.min.js') }}" defer></script>
        <?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
?>
        <!-- PAGINA INICIAL PARA USER LOGADO -->
        <!-- TopBar-->
            @include('includes.topbar')
        <!-- Fim do TopBar-->

        <!-- Inicio da Content -->
            @yield('content')
        <!-- Fim da Content -->

        <!-- Footer Inicio  -->
            @include('includes.rodape')
        <!-- Footer Fim -->

        <!-- Importação das SCRIPTS-->
        <!-- Vendor js -->
        <script src="{{ asset('js/vendor.min.js') }}"></script>


        <!-- App js -->
        <script src="{{ asset('js/app.min.js') }}" difer></script>

        <!-- Plugins js-->
        <script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
        <script src="{{ asset('js/pages/form-wizard.init.js') }}"></script>
        <script src="{{ asset('libs/custombox/custombox.min.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('libs/switchery/switchery.min.js') }}"></script>
        <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>
        <script src="{{ asset('libs/moment/moment.min.js') }}"></script>
        <script src="{{ asset('libs/x-editable/bootstrap-editable.min.js') }}"></script>
        <script src="{{ asset('libs/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('libs/jquery-knob/jquery.knob.min.js') }}"></script>
        <script src="{{ asset('libs/peity/jquery.peity.min.js') }}"></script>
    </body>
</html>