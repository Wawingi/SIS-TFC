@foreach($temas as $tema)
    <tr  title="Clique para ver" class="tabelaClicked clickable-roww" data-href='{{ url("verTrabalho/".base64_encode($tema->id)) }}'>
		<td>{{$loop->iteration}}</td>
        <td>
			<a>{{$tema->tema}} <i class="fas fa-folder-open"></i></a>
		</td>
        <td>{{$tema->nome}}</td>
        <td>{{$tema->orientador}}</td>
    </tr>
@endforeach
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
</script>
