<a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
    <i class="fe-bell noti-icon"></i>
    <span class="badge badge-danger rounded-circle noti-icon-badge">{{$contNotificacao}}</span>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-lg">
    <div class="dropdown-item noti-title">
        <h5 class="m-0">
            <span class="float-right">
                <a href="#" class="text-dark">
                    <small>Eliminar Todos</small>
                </a>
            </span>Notificações
        </h5>
    </div>
    <div class="slimscroll noti-scroll">
        @foreach($notificacoes as $notificacao)
        <a href="{{url('listarNotificacoes')}}" @if($notificacao->estado==0) class="dropdown-item notify-item active" @else class="dropdown-item notify-item" @endif>
            <div class="notify-icon bg-soft-primary text-primary">
                <i class="mdi mdi-bell-ring"></i>
            </div>
            <p class="notify-details">{{$notificacao->mensagem}}
                <small class="text-muted">{{date('d-m-Y H:i',strtotime($notificacao->created_at))}}</small>
            </p>
        </a>
        @endforeach
    </div>
    <a href="{{url('listarNotificacoes')}}" class="dropdown-item text-center text-primary notify-item notify-all">
        Ver todos
        <i class="fi-arrow-right"></i>
    </a>
</div>