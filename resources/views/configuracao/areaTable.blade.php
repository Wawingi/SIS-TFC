@if($isDeleted==0)
    @foreach($areas as $area)
        <tr>
          <td>{{$area->nome}}</td>
          <td class="text-center">
            <a title="Editar linha de investigação" href="#" id="{{$area->id}}" nome="{{$area->nome}}" class="pegar mr-3"><i class='fa fa-pencil-alt'></i></a>
            <a title="Eliminar linha de investigação" href="#" id="{{$area->id}}" class="eliminar"><i class='fa fa-trash-alt'></i></a>
          </td>
        </tr>
    @endforeach
@elseif($isDeleted==1)
    @foreach($areas as $area)
        <tr>
          <td>{{$area->nome}}</td>
          <td class="text-center">
            <a title="Recuperar linha de investigação" href="#" id="{{$area->id}}" class="restaurar"><i class='fa fa-trash-restore'></i></a>
          </td>
        </tr>
    @endforeach
@endif