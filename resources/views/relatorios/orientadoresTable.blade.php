@foreach($orientadores as $orientador)
    <tr class="tabelaClicked clickable-row">
        <td>{{$orientador->nome}}</td>
        <td>{{$orientador->faculdade}}</td>
        <td>{{$orientador->departamento}}</td>
    </tr>
@endforeach
        