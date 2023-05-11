@extends('layouts.admin')

@section('content')
    <div class="jumbotron">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card text-center mt-3 bg-info">
            <h2 class="display-4">Vragen</h2>
            <p>Maak nieuwe vraag aan</p>
            <div>
                <a class="btn btn-primary mb-4" href="{{ route('admin.create') }}" role="button">Create</a>
            </div>
        </div>

        @foreach($lists as $list)
            <div class="card text-center mt-3">
                <div class="card-header">
                    <h5 class="card-title">List</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-text">Title: {{ $list->title }}</h4>
                    <p class="card-text">Description: {{ $list->description }}</p>
                    <h5 class="card-title">Questions</h5>
                    <ul class="list-group">
                        @foreach($list->questions as $question)
                            <li class="list-group-item">{{ $question->question }}</li>
                        @endforeach
                    </ul>

                    <div class="mt-4">
                        <a class="btn btn-primary" href="{{ route('admin.edit', ['id' => $list->id]) }}" role="button">Edit</a>
                        <a class="btn btn-danger" href="{{ route('admin.delete', ['id' => $list->id]) }}" role="button">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
