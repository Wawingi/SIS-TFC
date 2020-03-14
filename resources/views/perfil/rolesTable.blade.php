@foreach($roles as $role)
    <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$role->nome}}</td>
        <td>{{$role->desc}}</td>
        <td style="text-align:center">
            <a href='#' id="{{$role->id}}" class="eliminar btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach