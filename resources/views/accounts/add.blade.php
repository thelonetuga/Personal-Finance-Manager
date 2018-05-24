@extends('layouts.navBar')

@section('title', 'Add Account')

@section('content')
    <div class="container">
        @if(count($errors) > 0)
            @include('partials.errors')
        @endif
            <form action="{{ action('AccountsController@update',$account->id) }}" method="post" class="form-group">
                {{csrf_field()}}
                {{method_field('put')}}
                @include('accounts.partials.add-edit')
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                    <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                </div>
            </form>
    </div>
@endsection('content')
