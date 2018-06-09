@extends('layouts.navBar')

@section('title', 'List accounts')
@if(count($errors) > 0)
    @include('partials.errors')
@endif
@section('content')
    <div class="container">
        <a class="btn btn-xs btn-primary" href="{{route('account.create')}}">Create Account</a>
        <br>
        <br>
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
                            <a class="btn btn-xs btn-primary" href="{{route('account.edit',$account->id)}}">Edit</a>
                            <a class="btn btn-xs btn-success" href="{{route('movements.account', $account->id)}}">Movements</a>
                            <form action="{{ action('AccountsController@accountDelete', $account->id) }}" method="POST"
                                  role="form" class="inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="account_id" value="{{ intval($account->account_id) }}">
                                <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                            </form>
                            @if($account->trashed())
                                <form action="{{ action('AccountsController@accountReopen', $account->id) }}"
                                      method="POST" role="form" class="inline">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="account_id" value="{{ intval($account->account_id) }}">
                                    <button type="submit" class="btn btn-xs btn-warning">Reopen</button>
                                </form>
                            @else
                                <form action="{{ action('AccountsController@accountClose', $account->id) }}"
                                      method="POST" role="form" class="inline">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="account_id" value="{{ intval($account->account_id) }}">
                                    <button type="submit" class="btn btn-xs btn-warning">Close</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <h2>No accounts found</h2>
        @endif
    </div>
@endsection('content')