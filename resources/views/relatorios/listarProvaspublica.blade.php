<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
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
                            <li class="breadcrumb-item active">Relatórios</li>
                            <li class="breadcrumb-item active">Listar Provas Pública</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Relatórios</h4>
                </div>
            </div>
        </div>

        <!-- Alerta de inserção sucesso -->
        @if(session('info'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong>
                    {{ session('info')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{url('baixar_relatorio_provapublica')}}">
                            @csrf
                            <div class="row">
                                <div class="col-9">
                                    <div class="form-group">
                                        <?php $departamentos = App\Model\Departamento::pegaDepartamentoByTipo(2,$sessao[0]->id_faculdade);?>  
                                        <select onchange="mudarDepartamento()" name="departamento" id="departamento" class="custom-select">
                                                <option selected disabled>Escolha o departamento</option>
                                            @foreach($departamentos as $departamento)
                                                <option value="{{$departamento->id}}">{{$departamento->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary btn-rounded float-right" type="submit"><i class="fas fa-download mr-1"></i>Baixar Relatório</button>
                                </div>
                            </div> 
                        </form>                      
                    </div>
                </div>
            </div>
        </div>
                
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="paginationFullNumbers" class="table table-bordered" cellspacing="0" width="100%">
                            <thead id="cabecatabela">
                                <tr>
                                    <th>Tema</th>
                                    <th>Nota</th>
                                    <th>Data da Realização</th>
                                </tr>
                            </thead>
                            <tbody id="tableOrientador">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    
        <!--Fim do conteudo-->
    </div> 
</div>
<script>
    function mudarDepartamento(){
        var id_departamento=$('#departamento').val();
    
        $.ajax({
            url: "{{ url('listarProvasPublica') }}/"+id_departamento,
            success:function(data){
                $('#tableOrientador').html(data);                
            },
            error: function(e)
			{
				alert("erro ao carregar linhas");
			}
        })
    };
</script>
@stop