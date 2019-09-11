@extends('layouts.booklist')

@section('content')
    <div class="container">
        <autor-component :id="{{ Request::segment(2) }}" ></autor-component>
    </div>
@endsection