@extends('layouts.navBar')

@section('title', 'Followers')

@section('content')
    <div class="container">
        <table class="table table-striped" >
            <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Link to Accounts</th>
            </tr>
            </thead>
            @foreach ($associates_of as $associate)
                @foreach ($users as $user)
                    @if (empty($associate->main_user_id))
                        <h2>No followers found</h2>
                    @else
                        <tbody>
                        <span class="associate-of"></span>
                        @if ($user->id == $associate->main_user_id )
                            <tr>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    <a class="btn btn-link"  href="{{ route('accounts.users',$associate->main_user_id) }}">Accounts</a>
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    @endif
                @endforeach
            @endforeach
        </table>
    </div>
@endsection