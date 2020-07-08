<?php 
    //sessão dos dados do utilizador logado
    //$sessao=session('dados_logado'); 
?>
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Configurações</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Perfil de Utilizador</a></li>
                            <li class="breadcrumb-item active">Ver Perfil</li>
                        </ol>
                    </div>                   
                    <h4 class="page-title">Ver Perfil</h4>
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
        @if(session('info'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Inclusão da Modal -->
        
        @include('includes.configuracao.modalPermission')

        <!--Inicio do conteudo-->          
            <br><br>          
            <div class="row float-right">
                <div class="col-lg-12">             
                    <a href="#" class="btn btn-sm btn-warning waves-effect waves-light btn-rounded" data-toggle="modal" data-target="#modalSave"><i class="mdi mdi-plus-circle mr-1"></i> Associar Permissão</a>     
                </div>
            </div>
            <br><br>
            <div class="card-box">
                <div class="row">                            
                    <div class="col-4">
                        <div class="card-box">
                            <form id="formularioSalvar" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" disabled value="{{$perfil->nome}}" id="entrada" class="form-control" name="nome" placeholder="ex: Administrador">
                                </div>    
                                <div class="form-group">
                                    <label for="name">Descrição</label>
                                    <input type="text" disabled value="{{$perfil->descricao}}" id="entrada" class="form-control" name="descricao" placeholder="ex: Administrador funcionário">
                                </div>   
                                <input type="hidden" disabled value="{{$perfil->id}}" id="idRole" class="form-control" name="idRole">   
                                <hr>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-box">
                            <table id="paginationFullNumbers" class="table table-bordered" width="100%">
                                <thead id="cabecatabela">
                                    <tr>
                                        <th>Perfil</th>
                                        <th>Descrição</th>
                                        <th class="text-center" style="width: 125px">Acções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{$permission->nome}}</td>
                                            <td>{{$permission->desc}}</td>
                                            <td class="text-center"><a title="Remover permissão do perfil" href="#" id="{{$permission->id}}" class="remover"><i class='SairGrupo mdi mdi-close mdi-18px'></i></a></td>
                                        </tr>
                                    @endforeach                                                            
                                </tbody>
                            </table>    
                        </div>
                    </div>
                </div>
            </div> 
                  
        <!-- FIm do conteudo -->
    </div> 
</div>
<script>
               

    $(document).ready(function () {
	    $('#paginationFullNumbers').DataTable({
			"pagingType": "full_numbers"
		});
	});


    $('#formularioSalvarPermission').submit(function(e){
        e.preventDefault();
        var request = new FormData(this);
     
        $.ajax({
            url:"{{ url('associarPermission') }}",
            method: "POST",
            data: request,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data){
                if(data == "Sucesso"){
                    Swal.fire({
                        text: "Permissão associada com sucesso.",
                        icon: 'success',
                        confirmButtonText: 'Fechar',
                        timer: 1500
                    })             
                    //carregarDataTable();
                    $('#formularioSalvarPermission')[0].reset();
                    $('#modalClose').click();
                    location.reload();
                }else{
                    Swal.fire({
                        text: 'Ocorreu um erro ao associar a permissão.',
                        icon: 'error',
                        confirmButtonText: 'Fechar'
                    })
                    $('#modalClose').click();
                }            
            },
            error: function(e){
                $('#formularioSalvarPermission')[0].reset();
                Swal.fire({
                    text: 'Ocorreu um erro ao associar a permissão.',
                    icon: 'error',
                    confirmButtonText: 'Fechar'
                })
                $('#modalClose').click();
            }
        });
    });

    $(document).on('click','.remover',function(e){
        Swal.fire({
			  title: 'Deseja realmente remover a permissão deste perfil? OBS: Perderá as regalias envolvidas.',
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Remover',
              cancelButtonText: 'Cancelar'
			}).then((result) => {
                if (result.value) {
                    e.preventDefault();
                    var idPermission = $(this).attr('id');
                    var idRole = $('#idRole').val();
                    $.ajax({
                        url: "{{ url('removerPermissao') }}/"+idPermission+"/"+idRole,
                        type: "GET",
                        success: function(data){
                            if(data='Sucesso'){
                                Swal.fire(
                                'Removido!',
                                'Removido com Sucesso.',
                                'success'
                                ),
                                location.reload();
                            }
                        },
                        error: function(e)
                        {
                            Swal.fire({
                                text: 'Ocorreu um erro ao remover a permissão.',
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