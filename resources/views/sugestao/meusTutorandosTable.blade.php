@foreach($sugestoes as $sugestao)
    <tr  title="Clique para ver" class="tabelaClicked clickable-row" data-href='{{ url("verSugestao/".base64_encode($sugestao->id)) }}'>
		<td>{{$loop->iteration}}</td>
        <td>
			<a>{{$sugestao->tema}} <i class="fas fa-folder-open"></i></a>
		</td>
        <td>{{$sugestao->nome}}</td>
        <td>
			@if($sugestao->estado==1) 
				<div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Publicado
					</div>
				</div>
            @elseif($sugestao->estado==2)
                <div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-icon-purple" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Selecionado
					</div>
				</div>
			@elseif($sugestao->estado==4)
                <div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Rejeitado
					</div>
				</div>
			@endif			
		</td>
    </tr>
@endforeach
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
</script>