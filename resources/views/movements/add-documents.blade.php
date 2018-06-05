@extends('layouts.navBar')

@section('title', 'Add Document')
@section('content')
    <div class="container">
        <form href="{{ route('documents.movement', $mov) }}" method="post" class="form-group" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <div>
                    <label for="document_file">Document</label>
                    <br>
                    <div class="form-control">
                        <input type="file" name="document_file">
                    </div>
                </div>
                <div class="form-group">
                    <label for="documentDescription">Document description</label>
                    <br>
                    <textarea rows="5" cols="100" name="documentDescription" id="documentDescription" placeholder="Enter text here..."></textarea>
                    @if ($errors->has('documentDescription'))
                                <em>{{ $errors->first('documentDescription') }}</em>
                    @endif
                </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="ok">Save</button>
                        <a type="button" class="btn btn-warning" name="cancel" href="{{ route('movements.account', $mov)}}">Cancel</a>
                    </div>
                </form>
            </div>
        </form>
    </div>
@endsection('content')
