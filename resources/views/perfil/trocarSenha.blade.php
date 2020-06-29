
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
                            <li class="breadcrumb-item active">Alterar Senha</li>
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
        <!-- Alerta de sucesso -->
        @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Alerta de erro -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong>
                    {{ session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        
        <br><br>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-12">  
                        <div  id="card-view" class="modal-content">
                            <div style="background-color:#3bafda" class="modal-header">
                                <h4 style="color:white" class="modal-title" id="myLargeModalLabel"><i class=' fas fa-user-lock mr-1'></i>  Alterar Senha </h4>
                            </div>
                            <form method="post" action="{{ url('trocarSenha') }}"> 
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label for="senha">Informe a senha actual</label>
                                                <input type="password" class="form-control" name="senhaactual" id="senhaactual" placeholder="Senha actual">                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label>Informe a nova senha</label>
                                                <input type="password" class="form-control" name="novasenha" id="novasenha" placeholder="Nova senha">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group mb-3">
                                                <label>Confirmar nova senha</label>
                                                <input type="password" class="form-control" name="confirmarsenha" id="confirmarsenha" placeholder="Confirmar a nova senha">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light"><i class="mdi mdi-lock mr-1"></i>Aterar</button>
                                </div>
                            </form> 
                        </div>     
                    </div>
                </div>                
            </div>
        </div>   
    </div> 
</div>
<script>
    
    $(document).on('click','.RedefinirSenha',function(e){
        Swal.fire({
            title: 'A senha será redefinida para padrão. Deseja continuar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Redefinir',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var id = $(this).attr('idPessoa');
                    $.ajax({
                        url: "{{ url('resetarSenha') }}/"+id,
                        type: "GET",
                        success: function(data){
                            carregarDataTable();
                            Swal.fire(
                            'Redefinida!',
                            'Senha redefinida com Sucesso.',
                            'success'
                            )
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao redefinir senha.',
                                icon: 'error',
                                confirmButtonText: 'Fechar'
                            })
                        }
                    });
                }
        });
    });
</script>    
@stop