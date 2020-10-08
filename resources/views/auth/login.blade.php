@extends('layouts.app')
@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                <!-- Alerta de inserção sucesso -->
                @if(session('info'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sucesso!</strong>
                            {{ session('info')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <div class="card-body p-4">
                        <form id="formularioLogar" method="post">
                            @csrf
                            <div class="text-center">
                                <h3><a href="#" class="logo-lg"><i class="  fas fa-user-graduate"></i> <span>SIS TFC</span> </a></h3>
                                <hr>
                                <p class="text-muted mb-4 mt-3">Informe o email e a senha para aceder a sua conta.</p>
                            </div>
                                <img  id="logando" src="{{ url('images/loader.gif') }}"/>
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email </label>
                                    <input class="form-control" name="email" type="email" id="email" required autofocus placeholder="Informe o email">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="password">Senha</label>
                                    <input class="form-control" name="password" type="password" required id="senha" placeholder="Informe a senha">
                                </div>
                                <div style="color:red;text-align:center" id="errorLogar"></div>
                                <br>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Log In   <i class="fas fa-arrow-right"></i></button>
                                </div>
                            <div class="text-center">
                                <h5> <a href="#" class=" ml-1">Esqueceu a sua senha?</a></h5>
                            </div>
                        </form>
                    </div> <!-- fim da card body -->
                </div>
            </div> <!-- fim da coluna -->
        </div>
        <!-- fim da linha -->
    </div>
    <!-- end container -->
</div>
<script>
    $('#formularioLogar').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
        $('#logando').show();
        $.ajax({
            url:"{{ url('logar') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                $('#logando').hide();
                if(data == "Sucesso"){
                    location.href="home";
                }else{
                    document.getElementById("email").style.border = "1px solid red";
                    document.getElementById("senha").style.border = "1px solid red";
                    document.getElementById("errorLogar").innerHTML = "Erro ao efectuar o login, verifique o email ou a senha.";
                }
            },
            error: function(e){
                $('#logando').hide();
                alert('Erro ao logar');
            }
        });
    });
</script>
@endsection
