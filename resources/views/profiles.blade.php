@extends('layouts.navBar')

@section('title', 'Profile users')

@section('content')
    <div class="container">
        <form action="{{action('UserController@profiles')}}" method="get">
            <input type="text" placeholder="Filter By Name.." name="name">
            <button type="submit" class="btn btn-sm btn-success">
                <i class="glyphicon glyphicon-search"></i>
            </button>
            <a class="btn  btn-primary btn-sm" href="{{ route('associates') }}">Associate</a>
            <a class="btn  btn-primary btn-sm" href="{{ route('associate.of') }}">Associate Of</a>
            <br>
        </form>

        @if (count($users))
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="text-align: center">Profile Photo</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th style="text-align: center">Member Associate</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    @php
                        $isAssociate = false;
                           foreach($associates as $associate){
                             if ($user->id == $associate->associated_user_id ){
                             $isAssociate = true;
                             break;
                             }
                        }
                    @endphp
                    <tr>
                        <td>
                            @if(empty($user->profile_photo))
                                <img src="img/avatars/default.png"
                                     style="width:50px; height:50px; float:left; border-radius:50%; margin-left:150px; alt:'';">
                            @else
                                <img src="{{asset('storage/profiles/'.$user->profile_photo)}}"
                                     style="width:50px; height:50px; float:left; border-radius:50%; margin-left:150px; alt:'';">
                            @endif
                        </td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td style="text-align: center">
                                @if ($isAssociate)
                                    <span>associate</span>
                                @else
                                <form action="{{action('AssociatesController@associatesPost')}}" method="POST" role="form" class="inline">
                                    @csrf
                                    <input type="hidden" name="associate_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-xs btn-success">Add_Associate</button>
                                </form>
                                @endif
                            @foreach($associates_of as $associateOf)
                                @if ($user->id == $associateOf->main_user_id )
                                    <span>associate-of</span>
                                    @if(Auth::user()->id != $user->id )
                                        <form action="{{ action('AssociatesController@associateOfDelete', $user->id) }}"
                                              method="POST" role="form" class="inline">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="associate_of_id" value="{{ $user->id }}">
                                            <button type="submit" class="btn btn-xs btn-danger">Desassociate-Of</button>
                                        </form>
                                    @endif
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