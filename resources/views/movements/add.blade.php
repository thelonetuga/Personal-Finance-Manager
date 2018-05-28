@extends('layouts.navBar')

@section('title', 'Add Movement')

@section('content')
    <div class="container">
        @if(count($errors) > 0)
            @include('partials.errors')
        @endif
            <form action="{{ action('MovementsController@update',$movement) }}" method="post" class="form-group">
                {{csrf_field()}}
                {{method_field('put')}}
                @include('movements.partials.add-edit')
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                    <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                </div>
            </form>
    </div>
@endsection('content')
