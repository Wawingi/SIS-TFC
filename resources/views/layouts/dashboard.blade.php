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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div id="trabalhos" style="width: 100%;height:300px"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <div id="contadores" style="width: 100%;height:300px"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--Fim do conteudo-->
    </div> 
</div>
<script>
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

    $(document).ready(function() {
        // Gráfico do tipo Barra
        var valores;
        $.ajax({
            async:false,
            url: "{{ url('contTrabalhosDepartamentos') }}",
            success:function(data){
                valores=data;
            },
            error: function(e)
			{
				alert(e);
			}
        });

        var myChart = echarts.init(document.getElementById('trabalhos'));
        var option = {
            color:['#3398DB'],
            tooltip:{
                trigger:'axis',
                axisPointer:{
                    type:'shadow'
                }
            },
            title: {
                text:'Evolução de Trabalhos',
                x:'center'
            },            
            grid:{
                left:'3%',
                right:'4%',
                bottom:'3%',
                containLabel:true
            },
            xAxis: {
                data: valores[0],
            },
            yAxis: {},
            series: [
                {
                    name: 'Departamentos',
                    type: 'bar',
                    data: valores[1],  
                }
            ]
        };

        // Gráfico do tipo Pie.
        var comparadores;
        $.ajax({
            async:false,
            url: "{{ url('contComparaTrabalhos') }}",
            success:function(data){
                comparadores=data;
            },
            error: function(e)
			{
				alert(e);
			}
        });

        myChart.setOption(option);
        var myChart = echarts.init(document.getElementById('contadores'));
        var option = {
            title: {
                text:'Comparativo de Trabalhos',
                x:'center'
            },
            tooltip: {
                trigger:'item',
                formatter:"{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient:'vertical',
                left:10,
                data: ['Trabalhos em Curso','Trabalhos Defendidos'],
                formatter: name => {
                    var series=myChart.getOption().series[0];
                    var value=series.data.filter(row=>row.name===name)[0].value;
                    return name+' '+value;
                },
            },
            series: [
                {
                    name: 'Trabalhos',
                    type: 'pie',
                    radius:'55%',
                    center:['50%','60%'],
                    data: [
                        {value:comparadores[0],name:comparadores[1]},
                        {value:comparadores[2],name:comparadores[3]},
                    ],
                    itemStyle:{
                        emphasis:{
                            shadowBlur:0,
                            shadowOffsetX:0,
                            shadowColor:'rgba(0,0,0,0)'
                        }
                    }  
                }
            ]
        };

        // Display the chart using the configuration items and data just specified.
        myChart.setOption(option);
    });

</script>
@stop