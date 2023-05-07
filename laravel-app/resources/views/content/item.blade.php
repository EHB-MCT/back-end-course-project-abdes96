@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="list">
            <h1>Item page</h1>
            <h2> de  title is {{$item->title}}</h2>
            <h2> de  content is {{$item->content}}</h2>

        </div>

    </div>
@endsection
