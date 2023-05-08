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
                <a class="btn btn-primary mb-4" href="{{route('admin.create')}}" role="button">Create</a>
            </div>
        </div>

        @foreach($items as $item)
            <div class="card text-center mt-3">
                <div class="card-header">
                    <h5 class="card-title">Vraag</h5>
                </div>
                <div class="card-body">
                    <h4 class="card-text"> titel:{{$item->title}}</h4>
                    <p class="card-text"> content:{{$item->content}}</p>

                    <a class="btn btn-primary mb-4" href="{{ route('admin.edit', ['id' => $item->id]) }}" role="button">Edit</a>
                    <a class="btn btn-danger mb-4" href="{{ route('admin.delete', ['id' => $item->id]) }}" role="button">Delete</a>

                </div>

            </div>
        @endforeach
    </div>
@endsection
