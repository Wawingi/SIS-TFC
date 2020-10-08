<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
?>
@foreach($envolventes as $envolvente)
    <tr>
		<td>{{$loop->iteration}}</td>
        <td>{{$envolvente->nome}}</td>
        <td>{{$envolvente->bi}}</td>
        <td>{{$envolvente->nome_curso}}</td>
        <td>
            @if($sessao[0]->id_pessoa==$envolvente->id_pessoa)
                <a href="#" idPessoa="{{$envolvente->id_pessoa}}" class="SairGrupo float-right"><i class='fas fa-times'></i> Sair do Grupo </a>
            @endif
        </td>
    </tr>
@endforeach
