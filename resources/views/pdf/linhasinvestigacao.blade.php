@extends('pdf.masterPDF')
@section('content')
<br>
<div class="cabecalho">
    <img height="90" src="data:image/jpg;base64,{{$logotipo}}">
    <p>UNIVERSIDADE AGOSTINHO NETO</p>
    <p>FACULDADE DE {{$linhas[0]->faculdade}}</p>
    <p id="dpto">Departamento de {{$linhas[0]->departamento}}</p>
    <p id="titulo">LISTA LINHAS DE INVESTIGAÇÃO</p>
</div>
<br>
<table class="tabela" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Linha de Investigação</th>
        </tr>
    </thead>
    <tbody>
        @foreach($linhas as $linha)
            <tr style="text-align:center">
                <td>{{$loop->iteration}}</td>
                <td>{{$linha->linha}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop