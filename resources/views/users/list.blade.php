@extends('layouts.navBar')

@section('title', 'List users')

@section('content')
    @auth

<div class="container">
    <form action="{{action('UserController@index')}}" method="get">
        <input type="text" placeholder="Filter By Name.." name="name">
        <input type="text" placeholder="Filter By Type.." name="type">
        <input type="text" placeholder="Filter By Status.." name="status">
        <button type="submit" class="btn btn-sm btn-success">
            <i class="glyphicon glyphicon-search"></i>
        </button>
        <br>
    </form>
    @if (count($users))
        <table class="table table-striped" style="background: #cce5ff">
            <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Registered At</th>
                <th>Admin</th>
                <th>Blocked</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if($user->admin)
                            <span class="user-is-admin">admin</span>
                        @endif
                        @if($user->blocked)
                                <span class="user-is-blocked">blocked</span>
                        @endif
                        <div class="form-group">
                            @if(Auth::user()->id != $user->id && $user->admin == 1)
                                    <form  method="post" action="{{route('users.demote', $user->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-xs btn-danger">Demote</button>
                                    </form>
                            @else
                                    <form method="post" action="{{route('users.promote', $user->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-xs btn-success">Promote</button>
                                    </form>
                             @endif
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            @if ($user->blocked)
                                <form  method="post" action="{{route('users.unblock', $user->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <button type="submit" class="btn btn-xs btn-success">Unblock</button>
                                </form>
                            @else
                                <form method="post" action="{{route('users.blocked', $user->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <button type="submit" class="btn btn-xs btn-danger">Block</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2>No users found</h2>
@endif
</div>
    @endauth
@endsection