@extends('pdf.masterPDF')
@section('content')
<br>
<div class="cabecalho">
    <img height="90" src="data:image/jpg;base64,{{$logotipo}}">
    <p>UNIVERSIDADE AGOSTINHO NETO</p>
    <p>FACULDADE DE {{$editais[0]->faculdade}}</p>
    <p id="dpto">Departamento de {{$editais[0]->departamento}}</p>
    <p id="titulo">LISTA DE EDITAIS</p>
</div>
<br>
<table class="tabela" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Estudante</th>
            <th>Tema</th>
            <th>Data Prevista</th>
            <th>Presidente</th>
            <th>Secretário</th>
            <th>1º Vogal</th>
            <th>2º Vogal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($editais as $edital)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$edital->nome}}</td>
                <td>{{$edital->tema}}</td>
                <td>{{date('d-m-Y',strtotime($edital->created_at))}}</td>
                <td>{{$edital->presidente}}</td>
                <td>{{$edital->secretario}}</td>
                <td>{{$edital->vogal_1}}</td>
                <td>{{$edital->vogal_2}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop