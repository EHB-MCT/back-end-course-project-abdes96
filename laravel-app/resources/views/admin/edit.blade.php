@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-4">Edit List</h1>
                    </div>
                    <div class="card-body">
                        @include('partials.error')

                        <form method="post" action="{{ route('admin.update') }}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $list->title }}" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ $list->description }}" placeholder="Enter description">
                            </div>

                            <h3>Questions</h3>
                            @foreach($list->questions as $index => $question)
                                <div class="form-group">
                                    <label for="question{{ $index + 1 }}">Question {{ $index + 1 }}</label>
                                    <input type="text" class="form-control" name="questions[]" value="{{ $question->question }}" placeholder="Enter question">
                                </div>
                            @endforeach

                            @csrf
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
