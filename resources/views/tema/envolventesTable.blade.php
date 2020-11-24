<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
?>
@foreach($envolventes as $envolvente)
    <tr>
        <td>{{$envolvente->nome}}</td>
        <td>{{$envolvente->bi}}</td>
        <td>{{$envolvente->nome_curso}}</td>
    </tr>
@endforeach
