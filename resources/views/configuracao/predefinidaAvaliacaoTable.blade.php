@foreach($predefinidas as $pr)
    <tr>
      <td>{{$pr->avaliacao}}</td>
      <td>{{$pr->descricao}}</td>
      <td class="text-center">
        <a title="Editar avaliação predefinida" href="#" id="{{$pr->id}}" avaliacao="{{$pr->avaliacao}}" descricao="{{$pr->descricao}}" class="pegar mr-3"><i class='fa fa-pencil-alt'></i></a>
        <a title="Eliminar avaliação predefinida" href="#" id="{{$pr->id}}" class="eliminar"><i class='fa fa-trash-alt'></i></a>
      </td>
    </tr>
@endforeach