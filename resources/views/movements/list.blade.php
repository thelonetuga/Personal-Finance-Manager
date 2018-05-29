@extends('layouts.navBar')

@section('title', 'List Movements')

@section('content')
    <div class="container">

        <a class="btn btn-xs btn-success" href="{{route('movement.create', $account)}}">Add new movement</a>
            <br>
        <br>
@if (count($movements))
    <table class="table table-striped" style="background: #cce5ff">
    <thead>
        <tr>
            <th>Category</th>
            <th>Date</th>
            <th>Value</th>
            <th>Type</th>
            <th>End balance</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($movements as $movement)

        <tr>
            <td>{{ $movement->typeToStr() }}</td>
            <td>{{ $movement->date }}</td>
            <td>{{ $movement->value }}</td>
            <td>{{ $movement->type }}</td>
            <td>{{ $movement->end_balance }}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('movement.edit',$movement)}}">Edit</a>
                <form action="{{ action('MovementsController@movementDelete', $movement->id) }}" method="POST" role="form" class="inline">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="account_id" value="{{ intval($movement->movement_id) }}">
                    <button type="submit" class="btn btn-xs btn-danger">Delete </button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No Movements found</h2>
@endif
    </div>
@endsection