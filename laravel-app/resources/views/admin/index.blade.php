@extends('layouts.admin')

@section('content')

    <div class="jumbotron">
        @if(session('forminput'))
        <div class="alert alert-success" role="alert">
            zoekertje aangemaakt met titel : {{ session('forminput') }}
        </div>
        @endif

        <div class="card text-center mt-3 bg-info">

            <h2 class="display-4"> zoekertje 1</h2>
            <p class="lead"> Boardgames</p>
            <p>allerhande boardgames</p>
            <div>
                <a  class="btn btn-primary mb-4" href="{{route('admin.create')}}" role="button" >create</a>
                <a  class="btn btn-primary mb-4" href="{{route('admin.edit')}}" role="button" >edit</a>

            </div>
        </div>

    </div>
@endsection
