@extends('layouts.navBar')

@section('title', 'List Movements')

@section('content')
    <div class="container">
        <a class="btn btn-xs btn-success" href="{{route('movement.create', $account)}}">Add new movement</a>
        <br>
        <br>
        @if (count($movements))
            <table class="table table-striped" style="background: #cce5ff">
                <tr>
                    <td>Account: {{$account->id}}</td>
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
                            <a class="btn btn-xs btn-primary" href="{{route('movement.edit',$movement)}}">Edit</a>

                            <form action="{{ action('MovementsController@movementDelete', $movement->id) }}"
                                  method="POST" role="form" class="inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="account_id" value="{{ intval($movement->movement_id) }}">
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>
                            @isset($movement->document_id)
                                <a class="btn btn-xs btn-info"
                                   href="{{ action('DocumentsController@documentGet', $movement->document_id) }}"
                                   role="button">Download Document</a>
                                <br>
                                <form action="{{ action('DocumentsController@documentDelete', $movement->document_id) }}"
                                      method="POST" role="form" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger">Delete Document</button>
                                </form>
                            @else
                                <a class="btn btn-xs btn-warning" href="{{route('documents.form',$movement->id)}}"
                                   role="button">Upload Document</a>
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