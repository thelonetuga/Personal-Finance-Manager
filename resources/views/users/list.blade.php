@extends('layouts.navBar')

@section('title', 'List users')

@section('content')

<div class="container">
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
                            <div class="form-group">
                                @if ($user->admin)
                                    <form method="post" action="{{route('users.promote', $user->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-xs btn-danger">Demote</button>
                                    </form>
                                @else
                                    <form method="post" action="{{route('users.demote', $user->id)}}">
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
                                    <form method="post" action="{{route('users.block', $user->id)}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <button type="submit" class="btn btn-xs btn-success">Unblock</button>
                                    </form>
                                @else
                                    <form method="post" action="{{route('users.unblock', $user->id)}}">
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
@endsection