@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="rows">
            <h1>Edit page</h1>
            <form method="post" action="{{'itemedit'}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter title">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Content</label>
                    <input type="text" class="form-control"  placeholder="content">
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </div>
@endsection
