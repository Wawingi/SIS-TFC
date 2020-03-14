@foreach($cursos as $curso)
    <tr>
        <td style="text-align:center">{{$loop->iteration}}</td>
        <td style="text-align:center">{{$curso->nome}}</td>
        <td class="float-right">
            <a href="#" id="{{$curso->id}}" class="pegar btn btn-warning btn-sm"><i class='fa fa-pencil-alt'></i></a>
            <a href="#" id="{{$curso->id}}" class="eliminar btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach