@extends('layouts.navBar')

@section('title', 'List accounts')
@if(count($errors) > 0)
    @include('partials.errors')
@endif
@section('content')
    <div class="container">
        @if (count($accounts))
            <table class="table table-striped" style="background: #cce5ff">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Code</th>
                    <th>Date</th>
                    <th>Start balance</th>
                    <th>Description</th>
                    <th>Account Type</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($accounts as $account)
                    <tr>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->code }}</td>
                        <td>{{ $account->date }}</td>
                        <td>{{ $account->start_balance }}</td>
                        <td>{{ $account->description }}</td>
                        <td>{{ $account->typeToStr() }}</td>
                        <td>
                            <a class="btn btn-xs btn-success" href="{{route('movements.account', $account->id)}}">Movements</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No accounts found</h2>
        @endif
    </div>
@endsection('content')