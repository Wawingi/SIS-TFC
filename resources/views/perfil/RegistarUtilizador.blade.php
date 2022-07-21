<?php 
    //sessão dos dados do utilizador logado
    $dados=session('dados_logado'); 
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
                            <li class="breadcrumb-item active">Registar Utilizador</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Registar Utilizador</h4>
                </div>
            </div>
        </div>
        <br>
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
        
        <!--Inicio do conteudo formulario funcionario e chefe de departamento-->
        <?php if($dados[0]->tipo==1){ ?>      
            <div class="row">
            <hr>                             
                <div class="col-lg-12">                         
                    <div class="card">      
                        <div class="card-body">
                            <form method="post" id="validarFormularioFuncionario" action="{{ url('registarPessoa') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Tipo de Utilizador</label>
                                            <select id="tipo_registar1" name="tipo_registar" class="custom-select">
                                                <option value="1">Funcionário do Departamento de Direcção</option>
                                                <option value="2">Funcionário do Departamento Estudantil</option>
                                            </select>                                          
                                        </div>
                                    </div>
                                </div>
                                <hr>                                                    
                                <!-- 1ª Linha -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
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
                                </div>
                                <!-- 2ª Linha -->
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Tipo de documento</label>
                                            <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                                <option value="1">B.I</option>
                                                <option value="2">Outro</option>
                                            </select>                                          
                                        </div>
                                    </div>

                                    <div id="mostra_bi" class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>B.I n.º</label>
                                            <input type="text" class="form-control" name="bi" id="bi" placeholder="Informe o número do bilhete">
                                        </div>
                                    </div>

                                    <div id="mostra_outro" style="display:none" class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>Outro documento n.º</label>
                                            <input type="text" class="form-control" name="outro_doc" id="outro_doc" placeholder="Informe o número">
                                        
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                        </div>
                                    </div>
                                </div>
                                <!-- 3ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Faculdade</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                            <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-4" id="mostra_para_direcao1">
                                        <?php                                         
                                            $departamentos = App\Model\Departamento::pegaDepartamentoByTipo(1,$dados[0]->id_faculdade);
                                        ?>
                                        <div class="form-group mb-3">
                                            <label for="departamento">Departamento</label>
                                            <select id="departamento_direcao" name="departamento_direcao" class="selectpicker" data-live-search="true"  data-style="btn-light">
                                                <?php foreach($departamentos as $departamento): ?>
                                                    <option value="{{$departamento->id}}" @if(App\Model\Departamento::pegaChefeDepartamento($departamento->id)) disabled style="color:#e7eaed" @endif>{{$departamento->nome}}</option>
                                                <?php endforeach ?>
                                            </select>                                           
                                        </div>
                                    </div>     

                                    <div class="col-lg-4" id="mostra_para_dpto1" style="display:none">
                                        <?php 
                                            $departamentos = App\Model\Departamento::pegaDepartamentoByTipo(2,$dados[0]->id_faculdade);
                                        ?>
                                        <div class="form-group mb-3">
                                            <label for="departamento">Departamento</label>
                                            <select id="departamento_estudantil" name="departamento_estudantil" class="custom-select" data-live-search="true"  data-style="btn-light">
                                                <?php foreach($departamentos as $departamento): ?>
                                                    <option value="{{$departamento->id}}" @if(App\Model\Departamento::pegaChefeDepartamento($departamento->id)) disabled style="color:#e7eaed" @endif>{{$departamento->nome}}</option>
                                                <?php endforeach ?>
                                            </select>                                            
                                        </div>
                                    </div>                        
                                </div>
                                <!-- 3ª Linha --> 
                                <div class="row" id="mostra_para_dpto2" style="display:none">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Nível Acadêmico</label>
                                            <select name="nivel_academico" id="nivel_academico" class="custom-select">
                                                <option>Professor Assistente Estagiário</option>
                                                <option>Professor Assistente</option>
                                                <option>Professor Auxiliar</option>
                                                <option>Professor Titular</option>
                                                <option>Professor Catedrático</option>
                                            </select>  
                                        </div>
                                    </div>
                                </div>                          
                                <div class="row" id="mostra_para_direcao2">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Funcão</label>
                                            <select name="funcao_escolher" id="funcao_escolher" class="custom-select">
                                                <option value="1">Chefe do Departamento</option>
                                                <option value="2">Outro</option>
                                            </select>  
                                        </div>
                                    </div>
                                    <div id="mostra_funcao" class="col-lg-8" style="display:none">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Outra função</label>
                                            <input type="text" class="form-control" placeholder="Escreva aqui a função" name="funcao" id="funcao">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                <button type="reset" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Limpar</i></button>
                            </form>
                        </div> 
                    </div>
                </div> 
            </div>
        <?php } else { ?>
        <!--Inicio do conteudo formulario docente e estudante-->
            <div class="row">
            <hr>                             
                <div class="col-lg-12">                         
                    <div class="card">      
                        <div class="card-body">
                            <form method="post" id="validarFormularioPessoaDpto" action="{{ url('registarPessoa') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Tipo de Utilizador</label>
                                            <select id="tipo_registar2" name="tipo_registar" class="custom-select">
                                                <option value="2">Docente</option>
                                                <option value="3">Estudante</option>
                                            </select>                                          
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- 1ª Linha -->
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group mb-3">
                                            <label for="nome">Nome</label>
                                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe o nome">
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
                                </div>
                                <!-- 2ª Linha -->
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label for="data_nascimento">Data de nascimento</label>
                                            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group mb-3">
                                            <label for="funcao">Tipo de documento</label>
                                            <select id="tipo_documento" name="tipo_documento" class="custom-select">
                                                <option value="1">B.I</option>
                                                <option value="2">Outro</option>
                                            </select>                                          
                                        </div>
                                    </div>

                                    <div id="mostra_bi" class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>B.I n.º</label>
                                            <input type="text" class="form-control" name="bi" id="bi" placeholder="Informe o número do bilhete">
                                        </div>
                                    </div>

                                    <div id="mostra_outro" style="display:none" class="col-lg-3">
                                        <div class="form-group mb-3">
                                            <label>Outro documento n.º</label>
                                            <input type="text" class="form-control" name="outro_doc" id="outro_doc" placeholder="Informe o número">
                                        
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="informe o email">
                                        </div>
                                    </div>
                                </div>
                                <!-- 3ª Linha -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" class="form-control" name="telefone" id="telefone" min="0" placeholder="Informe o número telefónico">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Faculdade</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->faculdade }}" disabled required>
                                            <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->faculdade }}" name="faculdade" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group mb-3">
                                            <label for="tipo">Departamento</label>
                                            <input id="inputblock" type="text" class="form-control" value="{{ $dados[0]->departamento }}" disabled required>
                                            <input id="inputblock" type="hidden" class="form-control" value="{{ $dados[0]->departamento }}" name="departamento" required>
                                            <input type="hidden" class="form-control" value="{{ $dados[0]->id_departamento }}" name="departamento_estudantil">
                                        </div>
                                    </div>                                                                                                                                                  
                                </div>
                                <!-- 4ª Linha -->   
                                <div class="row" id="mostra_para_docente">
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
                                <!-- 4ª Linha -->
                                <div id="mostra_para_estudante" style="display:none">                    
                                    <div class="row">
                                        <?php 
                                            $cursos = App\Model\Curso::where('id_departamento',$dados[0]->id_departamento)->get();
                                        ?>               
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="funcao">Curso</label>
                                                <select name="curso" class="custom-select">
                                                <?php foreach($cursos as $curso): ?>
                                                    <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                                <?php endforeach ?>
                                                </select>                                          
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group mb-3">
                                                <label for="tipo">Número Mecanográfico</label>
                                                <input type="text" class="form-control" id="numero_mecanografico" name="numero_mecanografico">                     
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
                                </div>                                                     
                                <hr>
                                <button class="btn btn-primary btn-rounded"><i class="far fa-save"> Registar</i></button>
                                <button type="reset" class="btn btn-warning btn-rounded"><i class="far fa-window-close"> Limpar</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
        <?php } ?>    
    </div> 
</div>

<script>
    //Disable future date
    //var today = new Date().toISOString().split('T')[0];
    var today = '2002-01-01';
	document.getElementsByName("data_nascimento")[0].setAttribute('max', today);

    $(document).ready(function(){
        //validação da escolha do funcionario (Direcção ou Departamento Estudantil)
        document.getElementById("tipo_registar1").onchange = function() {
            var dado = document.getElementById("tipo_registar1");
            var itemSelecionado = dado.options[dado.selectedIndex].value;
                if (itemSelecionado==="1") {
                    document.getElementById("mostra_para_direcao1").style.display = 'block';
                    document.getElementById("mostra_para_direcao2").style.display = 'block';
                    document.getElementById("mostra_para_dpto1").style.display = 'none';
                    document.getElementById("mostra_para_dpto2").style.display = 'none';
                }else {
                    document.getElementById("mostra_para_direcao1").style.display = 'none';
                    document.getElementById("mostra_para_direcao2").style.display = 'none';
                    document.getElementById("mostra_para_dpto1").style.display = 'block';
                    document.getElementById("mostra_para_dpto2").style.display = 'block';
                }
        };

        //validação da escolha da outra função se não for chefe do DPTO
        document.getElementById("funcao_escolher").onchange = function() {
            var dado = document.getElementById("funcao_escolher");
            var itemSelecionado = dado.options[dado.selectedIndex].value;
            if (itemSelecionado==="1") {
                document.getElementById("mostra_funcao").style.display = 'none';
            }else {
                document.getElementById("mostra_funcao").style.display = 'block';
            }
        };
    });
        
    $(document).ready(function(){
        //validação da escolha do docente ou estudante
        document.getElementById("tipo_registar2").onchange = function() {
            var dado = document.getElementById("tipo_registar2");
            var itemSelecionado = dado.options[dado.selectedIndex].value;
            if (itemSelecionado==="2") {
                document.getElementById("mostra_para_estudante").style.display = 'none';
                document.getElementById("mostra_para_docente").style.display = 'block';
            }else {
                document.getElementById("mostra_para_estudante").style.display = 'block';
                document.getElementById("mostra_para_docente").style.display = 'none';
            }
        };
    });

    $(document).ready(function(){
        //validação da escolha da outra função se não for chefe do DPTO
        document.getElementById("tipo_documento").onchange = function() {
            var dado = document.getElementById("tipo_documento");
            var itemSelecionado = dado.options[dado.selectedIndex].value;
            if (itemSelecionado==="1") {
                document.getElementById("mostra_bi").style.display = 'block';
                document.getElementById("mostra_outro").style.display = 'none';
            }else {
                document.getElementById("mostra_bi").style.display = 'none';
                document.getElementById("mostra_outro").style.display = 'block';
            }
        };
    });

    // Validação do formulário do funcionário
    $( "#validarFormularioFuncionario").validate( {
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/
			},
			bi: {
				required: true,
                pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
				minlength:14,
                maxlength:14
			},
            data_nascimento: {
				required: true
			},
            telefone: {
				required: true
			},
            email: {
				required: true
			},
            funcao: {
				required: true
			},
            outro_doc: {
				required: true
			}
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
			bi: {
                required: "O número do Bilhete deve ser fornecido.",
                pattern: "O padrão do bilhete está inválido.",
				minlength: "O tamanho mínimo deve ser 14 dígitos",
                maxlength: "O tamanho máximo deve ser 14 dígitos"
			},
            data_nascimento: {
				required: "A data de nascimento deve ser fornecida"
			},
            telefone: {
				required: "O número do telefone deve ser fornecido"
			},
            email: {
				required: "O email deve ser fornecido"
			},
            funcao: {
				required: "A função deve ser fornecida"
			},
            outro_doc: {
				required: "O número do documento ser fornecido"
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

    // Validação do formulário do docente
    $( "#validarFormularioPessoaDpto" ).validate( {
		rules: {					
			nome: {
				required: true,
                pattern: /^[a-zA-ZáÁàÀçÇéÉèÈõÕóÓãÃúÚ\s]+$/
			},
			bi: {
				required: true,
                pattern: /^[0-9]{9}[a-zA-Z]{2}[0-9]{3}$/,
				minlength:14,
                maxlength:14
			},
            data_nascimento: {
				required: true
			},
            telefone: {
				required: true
			},
            email: {
				required: true
			},
            numero_mecanografico: {
				required: true
			},
            outro_doc: {
				required: true
			}
		},
		messages: {					
			nome: {
                required: "O nome deve ser fornecido.",
                pattern: "Informe um nome válido contendo apenas letras alfabéticas"
			},
			bi: {
                required: "O número do Bilhete deve ser fornecido.",
                pattern: "O padrão do bilhete está inválido.",
				minlength: "O tamanho mínimo deve ser 14 dígitos",
                maxlength: "O tamanho máximo deve ser 14 dígitos"
			},
            data_nascimento: {
				required: "A data de nascimento deve ser fornecida"
			},
            telefone: {
				required: "O número do telefone deve ser fornecido"
			},
            email: {
				required: "O email deve ser fornecido"
			},
            numero_mecanografico: {
				required: "O número mecanográfico deve ser fornecido"
			},
            outro_doc: {
				required: "O número do documento ser fornecido"
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
@stop