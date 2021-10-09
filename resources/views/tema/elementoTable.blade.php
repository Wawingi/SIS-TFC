@foreach($elementos as $elemento)
<tr>
    <td>{{$loop->iteration}}</td>
    <td><a href='{{ url("abrirItem/".base64_encode($elemento->id)) }}' ficheiro="{{$elemento->anexo}}" class="AbrirElementoPdf"><i class="mdi mdi-file-pdf-outline"></i>{{$elemento->anexo}}</a></td>
    <td>
        @if($elemento->avaliacao==0)
        <div class="progress mb-1 progress-xl">
			<div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                Elemento Rejeitado
			</div>
		</div>
        @elseif($elemento->avaliacao==1)
        <div class="progress mb-1 progress-xl">
			<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				Elemento Aprovado
			</div>
		</div>        
        @elseif($elemento->avaliacao==3)
        <div class="progress mb-1 progress-xl">
			<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                Em Avaliação
			</div>
		</div>
        @endif
    </td>
    <td class="float-right">
        <a href="#" id_item="{{$elemento->id}}" avaliacao="{{$elemento->avaliacao}}" comentario="{{$elemento->comentario}}" data_avaliacao="{{date('d-m-Y',strtotime($elemento->updated_at))}}" data_registo="{{date('d-m-Y',strtotime($elemento->created_at))}}" predefinidas="{{$pr}}" class="verElemento"><i class='fas fa-eye mr-1'></i>Ver Elemento</a>
        @if($elemento->avaliacao==3)
            <a href="#" id_item="{{$elemento->id}}" class="avaliarELemento"><i class='fas fa-clipboard-check mr-1'></i>Avaliar o Elemento</a>
        @endif
    </td>
</tr>
@endforeach
<script> 
    $(document).on('click','.AbrirElementoPdf',function(e){
        e.preventDefault();

        var ficheiro = $(this).attr('ficheiro');
        let source="{{ url('/storage/propostas/itens')}}/"+ficheiro;

        $('.modalShowElementoPdf').modal('show');
        $('#nome_edit').val(ficheiro);
        $('#ficheiroElemento').attr('src', source); 
    });
    
    $(document).on('click','.verElemento',function(e){
        e.preventDefault();

        var comentario = $(this).attr('comentario');
        var data_registo = $(this).attr('data_registo');
        var data_avaliacao = $(this).attr('data_avaliacao');
        var id_item = $(this).attr('id_item');
        var predefinidas = $(this).attr('predefinidas');
        var avaliacao = $(this).attr('avaliacao');

        if(avaliacao==0){
            document.getElementById("predefinidas").style.display = 'block';
            document.getElementById("comentario").style.background = '#FDB5AF';
        }else if(avaliacao==1){
            document.getElementById("predefinidas").style.display = 'none';
            document.getElementById("comentario").style.background = '#91FBBE';
        }
        $('.modalVerElemento').modal('show');
        $('#comentario').val(comentario);
        $('#data_registo').val(data_registo);
        $('#data_avaliacao').val(data_avaliacao);
        $('#predefinidas').val(predefinidas);
    });
    
    $(document).on('click','.avaliarELemento',function(e){
        e.preventDefault();

        var id_item = $(this).attr('id_item');

        $('.modalAvaliarElemento').modal('show');
        $('#id_item').val(id_item);
    });

</script>
