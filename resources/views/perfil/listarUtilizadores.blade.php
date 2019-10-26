
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilizadores</a></li>
                            <li class="breadcrumb-item active">Listar utilizadores</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ strtoupper(Auth::user()->tipo) }}</h4>
                </div>
            </div>
        </div>
        <!--Inicio do conteudo-->   
                <br><br>   
                <div class="row">
                    @foreach($dados as $dado)
                    <div class="col-lg-4">
                        <div class="text-center card-box ribbon-box">
                            <div class="ribbon-two ribbon-two-success"><span>Admin</span></div>
                            <div class="clearfix"></div>
                            <div class="pt-2 pb-2">
                                <img src="{{ asset('images/users/user.jpg')}}" class="rounded-circle img-thumbnail avatar-xl" alt="profile-image">

                                <h4 class="mt-3 font-17"><a href="extras-profile.html" class="text-dark">{{$dado->nome}}</a></h4>
                                <p class="text-muted">{{$dado->funcao}} <span> | </p>
                                <p class="text-muted"><span> <a href="#">{{$dado->email}}</a> </span></p>
                                <hr>
                                <a href='{{ url("verperfilUtilizador/{$dado->id}") }}' class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-account-badge-horizontal mr-1"></i> Ver Perfil</a>
                                <a href="" class="btn btn-danger btn-sm waves-effect"><i class=" mdi mdi-delete-forever mr-1"></i> Eliminar Conta</a>
                            </div> <!-- end .padding -->
                        </div> <!-- end card-box-->
                    </div>
                    @endforeach 
                </div>
        <!--Fim do conteudo-->
    </div> 
</div>
@stop