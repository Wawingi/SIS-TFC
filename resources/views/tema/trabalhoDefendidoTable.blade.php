@foreach($trabalhos as $trabalho)
    <tr  title="Clique para ver" class="tabelaClicked clickable-row" data-href='{{ url("verTrabalhoDefendido/".base64_encode($trabalho->id)) }}'>
		<td>{{$loop->iteration}}</td>
        <td>
			<a>{{$trabalho->tema}} <i class="fas fa-folder-open"></i></a>
		</td>
        <td>{{$trabalho->nome}}</td>
        <td>{{$trabalho->nota}} Valores</td>
    </tr>
@endforeach
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
</script>
