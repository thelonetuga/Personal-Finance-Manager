@extends('layouts.navBar')

@section('title', 'Profile users')

@section('content')
<div class="container">
    <form action="{{action('UserController@profiles')}}" method="get">
        <input type="text" placeholder="Filter By Name.." name="name">
        <button type="submit" class="btn btn-sm btn-success">
            <i class="glyphicon glyphicon-search"></i>
        </button>
        <a class="btn  btn-primary btn-sm"   href="{{ route('associates.get') }}">He belong to</a>
        <a class="btn  btn-primary btn-sm"   href="{{ route('associate.of') }}">I Belong To</a>
        <br>
    </form>
    @if (count($users))
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th style="text-align: center">Profile Photo</th>
                    <th>Name</th>
                    <th style="text-align: center">Member Associate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            @if(empty($user->profile_photo))
                                <img src="img/avatars/default.png" style="width:50px; height:50px; float:left; border-radius:50%; margin-left:150px; alt:'';">
                            @else
                                <img src="storage/profiles/{{$user->profile_photo}}" style="width:50px; height:50px; float:left; border-radius:50%; margin-left:150px; alt:'';">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td style="text-align: center">
                        @foreach($associates as $associate)
                            @if ($user->id === $associate->associated_user_id )
                                 He belong to my group
                            @endif
                        @endforeach
                        @foreach($associates_of as $associate)
                            @if ($user->id === $associate->main_user_id )
                                I belong to his group
                            @endif
                        @endforeach
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