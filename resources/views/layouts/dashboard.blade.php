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
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!--COntadores estatísticas-->
        <div id="contadorEstatistica" class="row text-center mb-2">
        </div>
                
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table id="paginationFullNumbers" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Linhas de Investigação</th>
                                    <th>Departamento</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">
                               
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
    function carregarLinhasTable(){
        $.ajax({
            url: "{{ url('pegaGeralLinhaInvestigacao') }}",
            success:function(data){
                $('#dataTable').html(data);
                $('#paginationFullNumbers').DataTable({
                    "pagingType": "full_numbers"
                });
            },
            error: function(e)
			{
				alert("erro ao carregar linhas");
			}
        })
    }
    carregarLinhasTable();

    function carregarContabilidades(){
        $.ajax({
            url: "{{ url('contEstatisticas') }}",
            success:function(data){
                $('#contadorEstatistica').html(data);
            },
            error: function(e)
			{
				carregarContabilidades();
			}
        })
    }
    carregarContabilidades();
</script>
@stop