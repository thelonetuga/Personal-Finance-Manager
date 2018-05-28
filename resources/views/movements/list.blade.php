@extends('layouts.navBar')

@section('title', 'List Movements')

@section('content')
    <div class="container">
        <a class="btn btn-xs btn-success" href="{{route('movement.create', $account)}}">Add new movement</a>
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
                <a class="btn btn-xs btn-primary">Edit</a>
                <a class="btn btn-xs btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No Movements found</h2>
@endif
    </div>
@endsection