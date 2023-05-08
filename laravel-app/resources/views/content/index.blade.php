@extends('layouts.master')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">

        @foreach($items as $item)
    <div class="jumbotron">

         <h2 class="display-4"> Was je tevreden?</h2>
        <p class="lead"> {{$item['title']}}
        </p>
        <p>{{$item['content']}}</p>
        <div>
        <a  class="btn btn-primary   mb-4" href="{{route('item',['id' => $item->id]) }}" role="button" >details</a>
    </div>
    </div>

        @endforeach



    </div>


@endsection
