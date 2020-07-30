@if($isDeleted==0)
    @foreach($departamentos as $departamento)
        <tr title="Clique para ver o departamento" class="tabelaClicked clickable-row" data-href='{{ url("verDepartamento/".base64_encode($departamento->id)) }}'>
            <td>{{$departamento->nome}}</td>
            <td>{{$departamento->email}}</td>
            <td class="text-center">
                <a href="#" id="{{$departamento->id}}" nome="{{$departamento->nome}}" email="{{$departamento->email}}" telefone="{{$departamento->telefone}}" class="pegar mr-3" title="Editar departamento"><i class='fa fa-pencil-alt'></i></a>
                <a href="#" id="{{$departamento->id}}" class="eliminar" title="Eliminar departamento"><i class='fa fa-trash-alt'></i></a>
            </td>
        </tr>
    @endforeach
@elseif($isDeleted==1)
    @foreach($departamentos as $departamento)
        <tr>
            <td>{{$departamento->nome}}</td>
            <td>{{$departamento->email}}</td>
            <td class="text-center">
                <a href="#" id="{{$departamento->id}}" class="restaurar" title="Recuperar departamento"><i class='fa fa-trash-restore'></i></a>
            </td>
        </tr>
    @endforeach 
@endif
<script>
  jQuery().ready(function(){
    $(".clickable-row").click(function(){
        window.location = $(this).data("href");
    });
  });
</script>