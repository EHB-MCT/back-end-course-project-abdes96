@extends('layouts.master')

@section('content')

    <div class="container">

    <div class="card text-center mt-3 bg-info">

         <h2 class="display-4"> zoekertje 1</h2>
        <p class="lead"> Boardgames</p>
        <p>allerhande boardgames</p>
        <div>
        <a  class="btn btn-primary mb-4" href="{{route('item',['id'=> 1]) }}" role="button" >details</a>
    </div>
    </div>
        <div class="card text-center mt-5 bg-info">

        <h2 class="display-4"> zoekertje 2</h2>
        <p> gitaar</p>
            <div>
    <a  class="btn btn-primary mb-4" href = '#'>details</a>
            </div>
        </div>

        <div class="card text-center mb-5 mt-5 bg-info">
        <h2 class="display-4"> zoekertje 3</h2>
        <p> handboek Laravel</p>
            <div>
            <a  class="btn btn-primary mb-4" href = '#'>details</a>
            </div>
        </div>


    </div>


@endsection
