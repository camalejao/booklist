@extends('layouts.booklist')

@section('content')
    <div class="container">
        <livro-component :id="{{ Request::segment(2) }}" ></livro-component>
    </div>
@endsection