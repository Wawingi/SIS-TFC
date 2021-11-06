@extends('pdf.masterPDF')
@section('content')
<br>
<div class="cabecalho">
    <img height="90" src="data:image/jpg;base64,{{$logotipo}}">
    <p>UNIVERSIDADE AGOSTINHO NETO</p>
    <p>FACULDADE DE {{$provapublicas[0]->faculdade}}</p>
    <p id="dpto">Departamento de {{$provapublicas[0]->departamento}}</p>
    <p id="titulo">LISTA DE PROVAS PÚBLICA</p>
</div>
<br>
<table class="tabela" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Tema</th>
            <th>Nota</th>
            <th>Data da Realização</th>
        </tr>
    </thead>
    <tbody>
        @foreach($provapublicas as $pp)
            <tr style="text-align:center">
                <td>{{$loop->iteration}}</td>
                <td>{{$pp->tema}}</td>
                <td><B>{{$pp->nota}}</B> Valores</td>
                <td>{{date('d-m-Y',strtotime($pp->created_at))}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@stop