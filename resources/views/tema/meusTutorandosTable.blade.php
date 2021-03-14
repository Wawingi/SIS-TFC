@foreach($trabalhos as $trabalho)
    <tr  title="Clique para ver" class="tabelaClicked clickable-row" data-href='{{ url("verTrabalho/".base64_encode($trabalho->id)) }}'>
		<td>{{$loop->iteration}}</td>
        <td>
			<a>{{$trabalho->tema}} <i class="fas fa-folder-open"></i></a>
		</td>
        <td>{{$trabalho->nome}}</td>
        <td>
			@if($trabalho->estado==2)
				<div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Publicado
					</div>
				</div>
			@elseif($trabalho->estado==1)
				<div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Em desenvolvimento
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
