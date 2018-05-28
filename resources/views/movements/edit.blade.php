@extends('layouts.navBar')

@section('title', 'Edit Movement')

@section('content')
    <div class="container">
        @if(count($errors) > 0)
            @include('partials.errors')
        @endif
        <form action="{{ action('MovementsController@update',$account->id) }}" method="post" class="form-group">
            {{csrf_field()}}
            {{method_field('put')}}
            @include('accounts.partials.add-edit')
            <div class="form-group">
                <button type="submit" class="btn btn-success" name="ok">Save</button>
                <a type="button" class="btn btn-warning" name="cancel" href="{{ route('movements.account', $account->id)}}">Cancel</a>
            </div>
        </form>
    </div>
@endsection('content')
