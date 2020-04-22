@foreach($sugestoes as $sugestao)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$sugestao->tema}}</td>
        <td>{{$sugestao->id_area}}</td>
        <td>{{$sugestao->estado}}</td>
        <td class="float-right">
            <a href='#'  class="btn btn-primary btn-sm"><i class='fa fa-eye'></i></a>
            <a href="#" id="{{1}}" class="pegar btn btn-warning btn-sm"><i class='fa fa-pencil-alt'></i></a>
            <a href="#" id="{{1}}" class="eliminar btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach 