@if($isDeleted==0)
    @foreach($roles as $role)
        <tr title="Clique para ver o perfil" class="tabelaClicked clickable-row" data-href='{{ url("verRole/".base64_encode($role->id)."/".base64_encode($role->nome)."/".base64_encode($role->desc)."/".base64_encode($role->tipo)) }}'>
            <td>{{$role->nome}}</td>
            <td>{{$role->desc}}</td>
            <td class="text-center" style="width: 125px">
                <a title="Editar Perfil" href="#" id="{{$role->id}}" nome="{{$role->nome}}" desc="{{$role->desc}}" class="pegar mr-3"><i class='fa fa-pencil-alt'></i></a>
                <a title="Eliminar Perfil" href="#" id="{{$role->id}}" class="eliminar"><i class='fa fa-trash-alt'></i></a>     
            </td>
        </tr>
    @endforeach
@elseif($isDeleted==1)
    @foreach($roles as $role)
        <tr  data-href='{{ url("verRole/".base64_encode($role->id)."/".base64_encode($role->nome)."/".base64_encode($role->desc)."/".base64_encode($role->tipo)) }}'>
            <td>{{$role->nome}}</td>
            <td>{{$role->desc}}</td>
            <td class="text-center" style="width: 125px">
                <a title="Recuperar Perfil" href="#" id="{{$role->id}}" class="restaurar"><i class='fa fa-trash-restore'></i></a>     
            </td>
        </tr>
    @endforeach
@endif
<script>
    $(document).on('click','.clickable-row',function(e){
        if (e.target.tagName == 'TD') {
            window.location = $(this).data("href");
        }
    });
</script>