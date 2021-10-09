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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notificações</a></li>
                            <li class="breadcrumb-item active">Listar Notificações</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Listar Notificações</h4>
                </div>
            </div>
        </div>
        <!-- Alerta de inserção sucesso -->
        @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Erro!</strong>
                    {{ session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <br>
        <!-- Inclusão da Modal -->

        <!--Inicio do conteudo-->
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <table class="table table-borderless mb-0">
                            <tbody id="dataTable">
                                @foreach($notificacoes as $notificacao)
                                    <tr @if($notificacao->estado==0)class="status-notification"@endif>
                                        <td>
                                            <i style="color:#1abc9c" class="mdi-24px mdi mdi-bell-ring"></i>
                                        </td>
                                        <td>
                                            <p class="notify-details">{{$notificacao->mensagem}}
                                                <br><small class="text-muted">{{date('d-m-Y H:i',strtotime($notificacao->created_at))}}</small>
                                            </p>
                                        </td>
                                        <td>    
                                            <a href='{{ url("eliminarNotificacao/".base64_encode($notificacao->id)) }}' class="btn btn-danger btn-sm btn-rounded float-right"><i class='fas fa-trash'></i> Eliminar </a>
                                            <a href='{{ url("marcarNotificacao/".base64_encode($notificacao->id)) }}' class="btn btn-success btn-sm btn-rounded float-right mr-1"><i class='fas fa-check'></i> Marcar Lida </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Fim do conteudo -->
    </div>
</div>
<script>

</script>
@stop