@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Create List</h1>
                    </div>
                    <div class="card-body">
                        @include('partials.error')

                        <form method="post" action="{{ route('ListCreate') }}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter description">
                            </div>

                            <h3>Questions</h3>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-group">
                                    <label for="question{{ $i }}">Question {{ $i }}</label>
                                    <input type="text" class="form-control" name="questions[]" placeholder="Enter question">
                                </div>
                            @endfor

                            @csrf
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
