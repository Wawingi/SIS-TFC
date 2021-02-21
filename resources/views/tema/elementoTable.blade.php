<tr>
    <td width="15%">Item anexado:</td>
    <td><a href='{{ url("abrirItem/".base64_encode($elemento->id)) }}' target="_blank"><i class="mdi mdi-file-pdf-outline"></i>{{$elemento->anexo}}</a></td>
    <td width="15%">Data de Anexo:</td>
    <td><B>{{ date('d/m/Y',strtotime($elemento->created_at)) }}</B></td>
    <td class="float-right">
        <a href="#" onclick="showAvaliacaoElemento({{$elemento->titulo}},{{$elemento->id}})" class="mr-3"><i class='fas fa-clipboard-check mr-1'></i>Avaliar o Elemento</a>
        <a href="#" onclick="mudaAnexoElemento({{$elemento->titulo}})" class="mr-3"><i class='fa fa-pencil-alt mr-1'></i>Editar o Elemento</a>
    </td>
</tr>
@if($elemento->avaliacao==0)
    <tr>
        <td>
            Avaliação:
        </td>
        <td colspan="4">
            <textarea  style="color:white" readonly class="form-control bg-danger" name="descricao" rows="3">
                {{$elemento->comentario}}
            </textarea>                                                   
        </td>
    </tr>
@elseif($elemento->avaliacao==1)
    <tr>
        <td>
            Avaliação:{{$elemento->avaliacao}}
        </td>
        <td colspan="4">
            <input  style="color:white" readonly class="form-control bg-success" value="Este elemento teve aprovação com sucesso."/>                                                         
        </td>
    </tr>
@endif
