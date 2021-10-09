@foreach($editais as $edital)
    <tr class="tabelaClicked clickable-row">
        <td>{{$edital->nome}}</td>
        <td>{{$edital->tema}}</td>
        <td>{{date('d-m-Y',strtotime($edital->created_at))}}</td>
        <td>{{$edital->presidente}}</td>
        <td>{{$edital->secretario}}</td>
        <td>{{$edital->vogal_1}}</td>
        <td>{{$edital->vogal_2}}</td>
    </tr>
@endforeach
        