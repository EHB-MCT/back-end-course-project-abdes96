@extends('layouts.master')
@include('partials.header')

@section('content')
    <div class="jumbotron">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="jumbotron bg-info text-white">
                    <h1 class="display-4">Welkom bij de Kinesis Therapy Vragenlijst</h1>
                    <p class="lead">Hieronder vindt u de beschikbare lijsten. Klik op de knop om de vragenlijst in te vullen.</p>
                </div>
                <div class="card-deck">
                    @foreach($lists as $key => $list)
                        @if($list->list_type === 'multiple')
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $list->title }}</h5>
                                    <p class="card-text">{{ $list->description }}</p>
                                    <a href="{{ route('lists', ['id' => $list->id]) }}" class="btn btn-primary">Vragenlijst {{ $key + 1 }}</a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
