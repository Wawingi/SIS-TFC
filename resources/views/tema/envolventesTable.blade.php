<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
?>
@foreach($envolventes as $envolvente)
    <tr>
        <td>{{$envolvente->nome}}</td>
        <td>{{$envolvente->bi}}</td>
        <td>{{$envolvente->nome_curso}}</td>
        <td class="float-right">
            <a target="blank" href='{{ url("gerarActaDefesa/".base64_encode($envolvente->pessoa_id)) }}' class="btn btn-success btn-sm btn-rounded"><i class="fas fa-file-pdf"></i> Acta da Defesa</a>
            <a target="blank" href='{{ url("gerarActaSessaoDefesa/".base64_encode($envolvente->pessoa_id)) }}' class="btn btn-success btn-sm btn-rounded"><i class="fas fa-file-pdf"></i> Acta da Nota</a>
        </td>      
    </tr>
@endforeach
