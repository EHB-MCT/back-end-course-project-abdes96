@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="rows">
            <h1>Edit page</h1>
            @include('partials.error')

            <form method="post" action="{{ route('admin.update') }}">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $item->title }}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <input type="text" class="form-control" name="content" value="{{ $item->content }}">
                </div>
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
