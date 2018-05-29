@extends('layouts.navBar')

@section('title', 'Add Movement')

@section('content')
    <div class="container">
        @if(count($errors) > 0)
            @include('partials.errors')
        @endif
            <form action="{{ route('movement.store',$account) }}" method="post" class="form-group">
                {{csrf_field()}}
                @include('movements.partials.add-edit')
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="ok">Save</button>
                    <a class="btn btn-default" href="{{route('movements.account', $account)}}">Cancel</a>
                </div>
            </form>
    </div>
@endsection('content')
