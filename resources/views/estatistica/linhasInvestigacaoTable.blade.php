@foreach($linhas as $linha)
    <tr class="tabelaClicked clickable-row">
        <td>{{$linha->linha}}</td>
        <td>{{$linha->departamento}}</td>
    </tr>
@endforeach
        