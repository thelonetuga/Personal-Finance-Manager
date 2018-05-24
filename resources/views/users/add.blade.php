@extends('master')

@section('title', 'Add user')

@section('content')
@if(count($errors) > 0)
    @include('partials.errors')
@endif

<form action="{{route('users.store')}}" method="post" class="form-group">
    {{csrf_field()}}
    @include('users.partials.add-edit')
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input
            type="password" class="form-control"
            name="password" id="inputPassword"
            value="{{old('password')}}"/>
    </div>
    <div class="form-group">
        <label for="inputPasswordConfirmation">Password confirmation</label>
        <input
            type="password" class="form-control"
            name="password_confirmation" id="inputPasswordConfirmation"/>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Add</button>
        <a class="btn btn-default" href="{{route('users.index')}}">Cancel</a>
    </div>
</form>
@endsection
