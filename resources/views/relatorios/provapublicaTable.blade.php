@foreach($provapublicas as $pp)
    <tr class="tabelaClicked clickable-row">
        <td>{{$pp->tema}}</td>
        <td><B>{{$pp->nota}}</B> Valores</td>
        <td>{{date('d-m-Y',strtotime($pp->created_at))}}</td>
    </tr>
@endforeach
        