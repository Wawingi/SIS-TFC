@extends('pdf.masterPDF')
@section('content')
<br>
<div class="cabecalho">
    <img height="90" src="data:image/jpg;base64,{{$logotipo}}">
    <p>UNIVERSIDADE AGOSTINHO NETO</p>
    <p>FACULDADE DE {{$orientadores[0]->faculdade}}</p>
    <p id="dpto">Departamento de {{$orientadores[0]->departamento}}</p>
    <p id="titulo">LISTA DE ORIENTADORES</p>
</div>
<br>
<table class="tabela" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Faculdade</th>
            <th>Departamento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orientadores as $orientador)
            <tr class="tabelaClicked clickable-row">
                <td>{{$loop->iteration}}</td>
                <td>{{$orientador->nome}}</td>
                <td>{{$orientador->faculdade}}</td>
                <td>{{$orientador->departamento}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop