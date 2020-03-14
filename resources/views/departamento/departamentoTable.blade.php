@foreach($departamentos as $departamento)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$departamento->nome}}</td>
        <td>{{$departamento->chefe_departamento}}</td>
        <td>{{$departamento->email}}</td>
        <td>{{$departamento->telefone}}</td>
        <td class="float-right">
            <a href='{{ url("verDepartamento/".base64_encode($departamento->id)) }}'  class="btn btn-primary btn-sm"><i class='fa fa-eye'></i></a>
            <a href="#" id="{{$departamento->id}}" class="pegar btn btn-warning btn-sm"><i class='fa fa-pencil-alt'></i></a>
            <a href="#" id="{{$departamento->id}}" class="eliminar btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
        </td>
    </tr>
@endforeach 