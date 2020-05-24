@foreach($areas as $area)
    <tr>
		<td>{{$loop->iteration}}</td>
        <td>{{$area->nome}}</td>
        <td>
          @if($area->deleted_at == NULL)
            <div class="progress mb-1 progress-xl">
              <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Activo</div>
            </div>
          @else 
            <div class="progress mb-1 progress-xl">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Eliminado</div>
            </div>
          @endif       
        </td>
        <td>
			      <a href="#" id="{{$area->id}}" nome="{{$area->nome}}" class="pegar btn btn-warning btn-sm"><i class='fa fa-pencil-alt'></i></a>
            @if($area->deleted_at == NULL)
              <a href="#" id="{{$area->id}}" class="eliminar btn btn-danger btn-sm"><i class='fa fa-trash-alt'></i></a>
            @else 
              <a href="#" id="{{$area->id}}" class="restaurar btn btn-primary btn-sm"><i class=' fas fa-trash-restore'></i></a>
            @endif             				
		    </td>
    </tr>
@endforeach