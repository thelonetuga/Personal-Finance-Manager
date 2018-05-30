@extends('layouts.navBar')

@section('title', 'Followers')

@section('content')
    <div class="container">
        <table class="table table-striped" >
            <thead>
            <tr>
                <th>Email</th>
                <th>Name</th>
            </tr>
            </thead>
            @foreach ($associates as $associate)
                @foreach ($users as $user)
                    @if (empty($associate->associated_user_id))
                        <h2>No followers found</h2>
                    @else
                        <tbody>
                        <span class="associate"></span>
                            @if ($user->id == $associate->associated_user_id )
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
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