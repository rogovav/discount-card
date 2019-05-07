@extends('app')

@section('content')
    <div class="col row">
        <div class="col-6">
            <a href="{{ route('getXML') }}" class="btn btn-block btn-success">Download</a>
        </div>
        <div class="col-6">
            <a href="{{ route('getXML') }}" class="btn btn-block btn-info">Upload</a>
        </div>
    </div>
@endsection
