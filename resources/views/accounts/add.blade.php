@extends('layouts.navBar')

@section('title', 'Add Account')

@section('content')
    @if(count($errors) > 0)
        @include('partials.errors')
    @endif
<div class="container">
    <form action="{{route('account.store')}}" method="post" class="form-group">
        {{csrf_field()}}
        @include('accounts.partials.add-edit')
        <div class="form-group">
            <button type="submit" class="btn btn-success" name="ok">Add</button>
            <a class="btn btn-default" href="{{route('accounts.users', Auth::user()->id)}}">Cancel</a>
        </div>
    </form>
</div>
@endsection
