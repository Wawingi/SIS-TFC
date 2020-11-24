<?php
//sessão dos dados do utilizador logado
$sessao = session('dados_logado');
?>
@foreach($envolventes as $envolvente)
    <tr>
        <td>{{$envolvente->nome}}</td>
        <td>{{$envolvente->bi}}</td>
        <td>{{$envolvente->nome_curso}}</td>
        <td>
            @if($envolvente->estado==1)
                <i class="check fas fa-user-check"> Adicionado</i>
            @else
                <i class="waiting fas fa-user-clock"> Pendente</i>
            @endif
        </td>
        <td>
            @if($sessao[0]->id_pessoa==$envolvente->id_pessoa && $estadoSugestao !=3)
                <a href="#" idPessoa="{{$envolvente->id_pessoa}}" class="SairGrupo float-right"><i class='fas fa-times'></i> Abandonar </a>
            @endif
        </td>
    </tr>
@endforeach
