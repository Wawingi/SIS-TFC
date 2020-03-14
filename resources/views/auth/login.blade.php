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
                                <form method="POST" action="{{ url('logar') }}">
                                    @csrf
                                    <div class="text-center w-75 m-auto">
                                        <h3><a href="#" class="logo-lg"><i class="  fas fa-user-graduate"></i> <span>SIS TFC</span> </a></h3>
                                        <hr>
                                        <p class="text-muted mb-4 mt-3">Informe o email e a senha para aceder a sua conta.</p>
                                    </div>

                                        <div class="form-group mb-3">
                                            <label for="emailaddress">Email </label>
                                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" id="email" value="{{ old('email') }}" required autofocus placeholder="Informe o email">
                                            
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="password">Senha</label>
                                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" required id="senha" placeholder="Informe a senha">

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                                <label class="custom-control-label" for="checkbox-signin">Lembrar-me</label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                        </div>

                                    <div class="text-center">
                                        <h5> <a href="#" class=" ml-1">Esqueceu a sua senha?</a></h5>
                                    </div>
                                </form>
                            </div> <!-- fim da card body -->
                        </div>
                        <!-- fim da card -->

                        <!-- fim da linha -->

                    </div> <!-- fim da coluna -->
                </div>
                <!-- fim da linha -->
            </div>
            <!-- end container -->
        </div>
@endsection
