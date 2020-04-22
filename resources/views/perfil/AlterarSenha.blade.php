<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados'); 
?>
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
        <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.js') }}"></script>
        <br>
        <div class="wrapper">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">

                            <div id="inforedefinirsenha" style="margin-top:-100px" class="alert alert-warning" role="alert">
                                <p>Por favor, redefina a tua senha! </p>
                                <p>informe uma senha segura composta por letras e caractéres especiais</P>
                            </div>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS TFC</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Utilizadores</a></li>
                                    <li class="breadcrumb-item active">Definir Senha</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- mensagens de validação de erros -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- fim de mensagens de validação de erros -->
                
                <!-- Alerta de inserção sucesso -->

                <!--Inicio do conteudo-->     
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">DEFINIR SENHA</h4><hr>
                                <form method="post" id="formularioAlterarSenha" action="{{ url('redefinirSenha') }}">
                                    @csrf
                                    <!-- 1ª Linha -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="senha">Nova Senha</label>
                                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Informe a senha">                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2ª Linha -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="confirmarsenha">Confirmar Nova Senha</label>
                                                <input type="password" class="form-control" name="confirmarsenha" id="confirmarsenha" placeholder="Informe a nova senha">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <button class="btn btn-primary"><i class="far fa-save"> Redefinir</i></button>
                                </form>
                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                </div> 
                <!--Fim do conteudo-->
            </div> 
        </div>
        <script>
            $( "#formularioAlterarSenha" ).validate( {
				rules: {					
					senha: {
						required: true,
						minlength:6,
					},
					confirmarsenha: {
						required: true,
						minlength:6,
						equalTo: "#senha"
					}
				},
				messages: {					
					senha: {
                        required: "A senha deve ser fornecida.",
						minlength:"Tamanho muito inferior, forneça valor com mais de 5 dígitos"
					},
					confirmarsenha: {
                        required: "A senha deve ser fornecida.",
						minlength:"Tamanho muito inferior, forneça valor com mais de 5 dígitos",
						equalTo: "As senhas devem ser iguais"
					}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `invalid-feedback` class to the error element
					error.addClass( "invalid-feedback" );
					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.next( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
				}
            });
        </script>
        <script src="{{ asset('js/vendor.min.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('js/app.min.js') }}" difer></script>
        <!-- Plugins js-->
        <script src="{{ asset('libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>
        <script src="{{ asset('js/pages/form-wizard.init.js') }}"></script>
    </body>
</html>