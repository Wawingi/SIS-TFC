<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<!-- Mirrored from coderthemes.com/minton/layouts/horizontal/blue/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Jun 2019 10:21:44 GMT -->
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
        
    </head>

    <body>
        
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
        
    </body>
</html>