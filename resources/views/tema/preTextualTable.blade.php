<tr style="background:">
    <td width="15%">Item anexado:</td>
    <td><a href='{{ url("abrirItem/".base64_encode($pretextual->id)) }}' target="_blank"><i class="mdi mdi-file-pdf-outline"></i>{{$pretextual->anexo}}</a></td>
    <td width="15%">Data de Anexo:</td>
    <td><B>{{date('d/m/Y',strtotime($pretextual->created_at))}}</B></td>
    <td class="float-right">
        <a href="#" onclick="showAvaliacaoElemento(1,{{$pretextual->id}})" class="mr-3"><i class='fas fa-clipboard-check mr-1'></i>Avaliar o Elemento</a>
        <a href="#" onclick="mudaAnexoElemento()" class="mr-3"><i class='fa fa-pencil-alt mr-1'></i>Editar o Elemento</a>
    </td>
</tr>
