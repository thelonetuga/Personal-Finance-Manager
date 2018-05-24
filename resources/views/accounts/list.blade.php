@php
    $movements = App\Movement::where('account_id', '=', Auth::id() )->count();
@endphp

@extends('layouts.navBar')

@section('title', 'List accounts')

@section('content')
    <div class="container">
@if (count($accounts))
    <a class="btn btn-xs btn-primary" href="{{route('account.create')}}">Create Account</a>
    <table class="table table-striped" style="background: #cce5ff">
    <thead>
        <tr>
            <th>Date</th>
            <th>Start balance</th>
            <th>Description</th>
            <th>Account Type</th>
            <th>Number of Movements</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($accounts as $account)
        <tr>
            <td>{{ $account->date }}</td>
            <td>{{ $account->start_balance }}</td>
            <td>{{ $account->description }}</td>
            <td>{{ $account->typeToStr() }}</td>
            <td>{{ $movements }}</td>
            <td>
                    <form  method="POST" role="form" class="inline">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <a class="btn btn-xs btn-primary" href="{{route('account.edit', $account->id)}}">Edit</a>
                        <a class="btn btn-xs btn-primary" href="{{route('movements.account', $account->id)}}">Movements</a>
                        <a type="submit" href="{{route('account.delete', $account->id)}}" class="btn btn-xs btn-danger">Delete</a>
                    </form>

            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No accounts found</h2>
@endif
    </div>
@endsection('content')