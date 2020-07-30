@if($isDeleted==0)
    @foreach($cursos as $curso)
        <tr>
            <td class="text-center"><i class="fas fa-book-reader"></i></td>
            <td>{{$curso->nome}}</td>
            <td class="text-center">
                <a title="Editar curso" href="#" id="{{$curso->id}}" nome="{{$curso->nome}}" class="pegar mr-3"><i class='fa fa-pencil-alt'></i></a>
                <a title="Eliminar curso" href="#" id="{{$curso->id}}" class="eliminar"><i class='fa fa-trash-alt'></i></a>
            </td>
        </tr>
    @endforeach
@elseif($isDeleted==1)
    @foreach($cursos as $curso)
        <tr>
            <td class="text-center"><i class="fas fa-book-reader"></i></td>
            <td>{{$curso->nome}}</td>
            <td class="text-center">
                <a title="Recuperar curso" href="#" id="{{$curso->id}}" class="restaurar"><i class='fa fa-trash-restore'></i></a>
            </td>
        </tr>
    @endforeach
@endif