@extends('layouts.master')
@include('partials.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <h1 class="text-white">Vragenlijst</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">{{ $list->title }}</h2>
                        <h5 class="text-center">{{ $list->description }}</h5>
                        <h3>Questions:</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ $errors->first('answers.*') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('answer', ['id' => $list->id]) }}">
                            @csrf
                            @foreach ($list->questions as $question)
                                <div class="form-group">
                                    <label for="question{{ $question->id }}" class="text-white">{{ $question->question }}</label>
                                    <input type="number" class="form-control" name="answers[{{ $question->id }}]" id="question{{ $question->id }}" min="1" max="10">
                                </div>
                            @endforeach
                            <input type="hidden" name="list_id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
