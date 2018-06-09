@extends('layouts.navBar')

@section('title', 'Personal Finances Assistant')

@section('content')
    <div class="container">
        <div class="thumbnail text-center">
            <h1>Personal Finances Assistant</h1>
            <h2>Instituto Politécnico de Leiria</h2>
            <h4>Aplicações para a Internet</h4>
        </div>
        <div class="thumbnail">
            <table class="table table-striped">
                <thead>
                <th>Nome</th>
                <th>Número de Estudante</th>
                <th>Ano</th>
                <th>Regime</th>

                <thead>
                <tbody>
                <tr>
                    <td>Joao Henrique Lopes Marques</td>
                    <td>2161647</td>
                    <td>2</td>
                    <td>Diurno</td>
                </tr>
                <tr>
                    <td>Paulo Diogo Rosa Coelho Alves</td>
                    <td>2161503</td>
                    <td>2</td>
                    <td>Diurno</td>
                </tr>
                <tr>
                    <td>Dyllan Silva Pedro</td>
                    <td>2140250</td>
                    <td>4</td>
                    <td>Diurno</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection