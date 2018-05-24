@extends('master')

@section('title', 'Edit Profile')

@section('content')
@if(count($errors) > 0)
    @include('partials.errors')
@endif
<form action="{{route('users.update', $user)}}" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    {{method_field('put')}}
    @include('users.partials.add-edit')
    <div class="form-group">
        <div class="col-md-6 control-label">
            <button type="submit" class="btn btn-success" name="ok">Save</button>
            <a type="button" class="btn btn-warning" name="cancel" href="{{ route('profile')}}">Cancel</a>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <a class="btn btn-link" href="{{ route('password.store') }}">Reset Password</a>
        </div>
    </div>
</form>
@endsection
