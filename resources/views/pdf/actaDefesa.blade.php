@extends('pdf.masterPDF')
@section('content')
<br>
<div class="cabecalho">
    <img style="margin-left:-550px" height="120" src="data:image/jpg;base64,{{$estudante->logotipoUAN}}">
    <img style="margin-left:550px;position:fixed" height="90" src="data:image/jpg;base64,{{$estudante->logotipo}}">
    <p>Universidade Agostinho Neto</p>
    <p>FACULDADE DE {{$estudante->faculdade}} </p><br>
    <p id="dpto">ACTA DA LEITURA DO TRABALHO DE FIM DE CURSO</p>
    <p id="titulo">ACTA Nº._____ / {{$anoActual}}</p>
</div>

<div style="margin-left:45px;margin-right:15px;font-size:17px;text-align:justify">
    <p style="line-height:1.5">
        Em <U><B>Luanda</B></U>, aos <U><B>{{date('d-m-Y H:m:s',strtotime($estudante->data_defesa))}}</B></U> local <U><B>{{$estudante->local}}</B></U> 
        esteve reunido o Júri encarregue de julgar o Trabalho de Fim de Curso de <U><B>{{$estudante->nome_estudante}}</B></U> 
        Especialidade ___________________________________ do Departamento de <U><B>{{$estudante->departamento}}</B></U> 
        no ano lectivo de <B>{{$anoActual}}</B>. 
    </p>
    <p style="line-height:1.5">
        O Trabalho de Fim de Curso é:<br> <U><B>{{$estudante->tema}}</B></U> e foi tutorado por <U><B>{{$vogal_2->juri}}</B></U> docente (ou tutor convidado) do Departamento de <U><B>{{$vogal_2->departamento}}</B></U> da Universidade Agostinho Neto.<br>
        O Júri foi nomeado por despacho nº______/GD/_______ e está integrado pelos Srs. Drs.
    </p>
    <p style="line-height:1.5">
        Presidente <U><B>{{$presidente->juri}}</B></U> DEI: <U><B>{{$presidente->departamento}}</B></U><br>
        1º Vogal <U><B>{{$vogal_1->juri}}</B></U> DEI: <U><B>{{$vogal_1->departamento}}</B></U><br>
        2º Vogal <U><B>{{$vogal_2->juri}}</B></U> DEI: <U><B>{{$vogal_2->departamento}}</B></U>
    </p>
    <p style="line-height:1.5">
        Depois de lido e discutido o Trabalho de Fim do Curso o Júri decidiu atribuir a classificação de <U><B>{{$estudante->nota}}</B></U> valores.
    </p>
    <p>
        Observações:<br>
        ______________________________________________________________________<br>
        ______________________________________________________________________<br>
        ______________________________________________________________________<br>
    </p>
    <p>
        <span style="margin-left:70px">O Presidente</span>
        <span style="margin-left:280px">Os Vogais</span><br>
        _________________________
        <span style="margin-left:380px">_________________________</span><br><br>
        <span style="margin-left:380px">_________________________</span>
    </p>
    <p style="margin-top:-30px">
        <span style="margin-left:70px">O Secretário</span><br>
        _________________________
    </p>
</div>
@stop