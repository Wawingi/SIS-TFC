@foreach($predefesas as $predefesa)
    <tr>
        <td><i class="icon-texto-predefesa fas fa-calendar-check mr-1"></i>Data de realização: <span class="texto-predefesa">{{date('d-m-Y',strtotime($predefesa->created_at))}}</span></td>
        <td><i class="icon-texto-predefesa fas fa-sort-amount-up mr-1"></i>Avaliação: <span class="texto-predefesa">{{$predefesa->avaliacao}}</span></td>
        <td><i class="icon-texto-predefesa fas fa-exchange-alt mr-1"></i>Tipo: <span class="texto-predefesa">{{$predefesa->tipo}}</span></td>
        <td>
            <a href="#" id="{{$predefesa->id}}" class="eliminarPredefesa btn btn-danger btn-sm btn-rounded float-right"><i class='fa fa-trash-alt mr-2'> Eliminar</a></i>
            <a href="#" id="{{$predefesa->id}}" tipo="{{$predefesa->tipo}}"  avaliacao="{{$predefesa->avaliacao}}" datapredefesa="{{date('Y-m-d',strtotime($predefesa->created_at))}}" nota="{{$predefesa->nota}}" class="showEditPredefesa btn btn-warning btn-sm btn-rounded mr-2 float-right"><i class='fa fa-pencil-alt mr-2'> Editar</a></i>
        </td>
    </tr>     
    <tr>
        <td colspan="4">
            <textarea readonly class="form-control" rows="3">{{$predefesa->nota}}</textarea>
        </td>
    </tr>  
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>  
@endforeach
