
<?php 
    //sessão dos dados do utilizador logado
    $sessao=session('dados_logado'); 
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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utilizadores</a></li>
                            <li class="breadcrumb-item active">Editar Dados Utilizador</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
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
        <br><br>
        <!--Inicio do conteudo formulario funcionario-->
        <?php if($dados[0]->tipo==1){ ?>     
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><i class='fa fa-pencil-alt'></i> EDITAR FUNCIONÁRIO<a href='{{ url("listarUtilizadores")}}' class="float-right btn btn-primary waves-effect waves-light" data-overlayColor="#38414a"><i class="fe-users mr-1"></i> Listar Utilizadores</a><br><br></h4><hr>
                            <form method="post" action="{{ url('editarPessoa') }}" class="needs-validation" novalidate>
                                @csrf
                                <!-- 1ª Linha -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" value="{{$dados[0]->nome}}" placeholder="Informe o nome" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="bi">BI n.º</label>
                                            <input type="text" class="form-control" name="bi" id="bi" value="{{$dados[0]->bi}}" placeholder="número do bilhete" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{$dados[0]->data_nascimento}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" class="form-control" name="telefone" id="telefone" value="{{$dados[0]->telefone}}" min="0" placeholder="Informe o número telefónico" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{$dados[0]->email}}" placeholder="informe o email" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Faculdade</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" readyonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="genero">Genero</label><br>
                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                <label for="inlineRadio1"> Masculino </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="2" name="genero" checked>
                                                <label for="inlineRadio2"> Feminino </label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $departamentos = App\Model\Departamento::where('id_faculdade',$sessao[0]->id_faculdade)
                                                                                 ->where('tipo',1)
                                                                                 ->get();
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Departamento</label>
                                            <select id="tipo" name="departamento" class="custom-select">
                                                <?php foreach($departamentos as $departamento): ?>
                                                    <option>{{$departamento->nome}}</option>
                                                <?php endforeach ?>
                                            </select>                                            
                                        </div>
                                    </div>                                   
                                </div>
                                <!-- 3ª Linha -->                           
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Função</label>
                                            <input type="text" class="form-control" name="funcao" id="funcao" value="{{$dados[0]->funcao}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" value="1" name="tipo">
                                <input type="hidden" class="form-control" value="{{$dados[0]->pessoa_id}}" name="pessoa_id">
                                <hr>
                                <button class="btn btn-primary"><i class="far fa-save"> Editar</i></button>
                                <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning"><i class="far fa-window-close"> Cancelar</i></a>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
        <?php } else if($dados[0]->tipo==2) { ?>
            <!--Inicio do conteudo formulario docente e estudante-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><i class='fa fa-pencil-alt'></i> EDITAR DOCENTE<a href='{{ url("listarUtilizadores")}}' class="float-right btn btn-primary waves-effect waves-light" data-overlayColor="#38414a"><i class="fe-users mr-1"></i> Listar Utilizadores</a><br><br></h4><hr>
                            <form method="post" action="{{ url('editarPessoa') }}" class="needs-validation" novalidate>
                                @csrf
                                <!-- 1ª Linha -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" value="{{$dados[0]->nome}}" placeholder="Informe o nome" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="bi">BI n.º</label>
                                            <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete" value="{{$dados[0]->bi}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{$dados[0]->data_nascimento}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="genero">Genero</label><br>
                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                <label for="inlineRadio1"> Masculino </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="2" name="genero" >
                                                <label for="inlineRadio2"> Feminino </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="informe o email" value="{{$dados[0]->email}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico" value="{{$dados[0]->telefone}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Faculdade</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $sessao[0]->faculdade }}" name="faculdade" readyonly required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Departamento</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $sessao[0]->departamento }}" name="departamento" readyonly required>
                                            <input type="hidden" class="form-control" value="{{ $sessao[0]->id_departamento }}" name="id_departamento">
                                        </div>
                                    </div>                                                                                                                                                  
                                </div>
                                <!-- 4ª Linha -->   
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Nível Académico</label>
                                            <select name="nivel_academico" class="custom-select">
                                                <option>Professor Assistente Estagiário</option>
                                                <option>Professor Assistente</option>
                                                <option>Professor Auxiliar</option>
                                                <option>Professor Titular</option>
                                            </select>                                          
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" value="2" name="tipo">
                                <input type="hidden" class="form-control" value="{{$dados[0]->pessoa_id}}" name="pessoa_id">                                                      
                                <hr>
                                <button class="btn btn-primary"><i class="far fa-save"> Editar</i></button>
                                <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning"><i class="far fa-window-close"> Cancelar</i></a>
                            </form>
                        </div> 
                    </div> 
                </div> 
            </div>     
        <?php } else if ($dados[0]->tipo==3){ ?>
            <!-- conteudo do estudante-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title"><i class='fa fa-pencil-alt'></i> EDITAR ESTUDANTE<a href='{{ url("listarUtilizadores")}}' class="float-right btn btn-primary waves-effect waves-light" data-overlayColor="#38414a"><i class="fe-users mr-1"></i> Listar Utilizadores</a><br><br></h4><hr>
                            <form method="post" action="{{ url('editarPessoa') }}" class="needs-validation" novalidate>
                                @csrf
                                <!-- 1ª Linha -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome" value="{{$dados[0]->nome}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="bi">BI n.º</label>
                                            <input type="text" class="form-control" name="bi" id="bi" placeholder="número do bilhete" value="{{$dados[0]->bi}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento" value="{{$dados[0]->data_nascimento}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="genero">Genero</label><br>
                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="1" name="genero" checked>
                                                <label for="inlineRadio1"> Masculino </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="2" name="genero">
                                                <label for="inlineRadio2"> Feminino </label>
                                            </div>
                                        </div>
                                    </div>                                               

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="informe o email" value="{{$dados[0]->email}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <!-- 3ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico" value="{{$dados[0]->telefone}}" required>
                                            <div class="valid-feedback">
                                                Dado fornecido.
                                            </div>
                                        </div>
                                    </div>
                                                            
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="tipo">Faculdade</label>
                                                <input id="inputblock" type="text" class="form-control" value="{{ $sessao[0]->faculdade }}" name="faculdade" readyonly required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="tipo">Departamento</label>
                                                <input id="inputblock" type="text" class="form-control" value="{{ $sessao[0]->departamento }}" name="departamento" readyonly required>
                                                <input type="hidden" class="form-control" value="{{ $sessao[0]->id_departamento }}" name="id_departamento">
                                            </div>
                                        </div>                                                                     
                                </div>
                                <!-- 4ª Linha -->
                                <?php 
                                    $cursos = App\Model\Curso::where('id_departamento',$sessao[0]->id_departamento)->get();
                                ?>                     
                                <div class="row">              
                                    <div id="curso" class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Curso</label>
                                            <select name="curso" class="custom-select">
                                            <?php foreach($cursos as $curso): ?>
                                                <option>{{$curso->nome}}</option>
                                            <?php endforeach ?>
                                            </select>                                          
                                        </div>
                                    </div>
                                    <div id="numero_mecanografico" class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Número Mecanográfico</label>
                                            <input type="text" class="form-control" name="numero_mecanografico" value="{{$dados[0]->numero_mecanografico}}"  required>                     
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="genero">Periodo</label><br>
                                            <div style="margin-left:7px;margin-top:10px" class="radio radio-info form-check-inline">
                                                <input type="radio" id="inlineRadio1" value="Diurno" name="periodo" checked>
                                                <label for="inlineRadio1"> Diurno </label>
                                            </div>
                                            <div class="radio form-check-inline">
                                                <input type="radio" id="inlineRadio2" value="Nocturno" name="periodo">
                                                <label for="inlineRadio2"> Nocturno </label>
                                            </div>
                                        </div>
                                    </div>                                                                   
                                </div>
                                <input type="hidden" class="form-control" value="3" name="tipo">
                                <input type="hidden" class="form-control" value="{{$dados[0]->pessoa_id}}" name="pessoa_id">
                                <hr>
                                <button class="btn btn-primary"><i class="far fa-save"> Editar</i></button>
                                <a href="{{ url('listarUtilizadores') }}" class="btn btn-warning"><i class="far fa-window-close"> Cancelar</i></a>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        <?php } ?> 
        <!--Fim do conteudo-->
    </div> 
</div>
   
@stop