@foreach($sugestoes as $sugestao)
    <tr>
		<td>{{$loop->iteration}}</td>
        <td>
			<a href='{{ url("verSugestao/".base64_encode($sugestao->id)) }}'>{{$sugestao->tema}} <i class="fas fa-folder-open"></i></a>
		</td>
        <td>{{$sugestao->nome}}</td>
		<td>{{$sugestao->orientador}}</td>
        <td>
			@if($sugestao->estado==1) 
				<div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Publicado
					</div>
				</div>
			@elseif($sugestao->estado==3)
				<div class="progress mb-1 progress-xl">
					<div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
						Em desenvolvimento
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