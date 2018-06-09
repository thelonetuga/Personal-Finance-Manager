@extends('layouts.navBar')

@section('title', 'List Movements')

@section('content')
    <div class="container">
        <br>
        <br>
        @if (count($movements))
            <table class="table table-striped" style="background: #cce5ff">
                <tr>
                    <td>Account: {{$account->id}}</td>
                    <td>Account: {{$account->current_balance}}</td>
                </tr>
            </table>
            <h3>Account movements:</h3>
            <table class="table table-striped" style="background: #cce5ff">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Value</th>
                    <th>Start balance</th>
                    <th>End balance</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($movements as $movement)
                    <tr>
                        <td>{{ $movement->id }}</td>
                        @if($movement->movement_category_id <'12')
                            <td>{{ $movement->type ='expense' }}</td>
                        @else
                            <td>{{ $movement->type ='revenue' }}</td>
                        @endif
                        <td>{{ $movement->typeToStr() }}</td>
                        <td>{{ $movement->date }}</td>
                        <td>{{ $movement->value }}</td>
                        <td>{{ $movement->start_balance }}</td>
                        <td>{{ $movement->end_balance }}</td>

                        <td>
                            @isset($movement->document_id)
                                <a class="btn btn-xs btn-info"
                                   href="{{ action('DocumentsController@documentGet', $movement->document_id) }}"
                                   role="button">Download Document</a>
                                <br>
                                <a class="btn btn-xs btn-success"
                                   href="{{ action('DocumentsController@documentView', $movement->document_id) }}"
                                   role="button">View Document</a>
                                <br>
                            @endisset
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No Movements found</h2>
        @endif
    </div>
@endsection