@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="jumbotron">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card text-center mt-3 bg-info">
                <h2 class="display-4">Vragenlijsten</h2>
                <p>Maak een nieuwe vraaglijst aan</p>
                <div>
                    <a class="btn btn-primary mb-4" href="{{ route('admin.create') }}" role="button">Aanmaken</a>
                </div>
            </div>


                @foreach($lists as $list)
                    <div class="card text-center mt-3">
                        <div class="card-header">
                            <h5 class="card-title">Vragenlijst</h5>
                        <div class="mt-2">
                            <a class="btn btn-success" href="{{ route('list.statistics', ['id' => $list->id]) }}" role="button">Bekijk Statistieken</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-text">Titel: {{ $list->title }}</h4>
                        <p class="card-text">Beschrijving: {{ $list->description }}</p>
                        <h5 class="card-title">Vragen</h5>
                        <ul class="list-group">
                            @foreach($list->questions as $question)
                                <li class="list-group-item">{{ $question->question }}</li>
                            @endforeach
                        </ul>

                        <div class="mt-4">
                            <a class="btn btn-primary" href="{{ route('admin.edit', ['id' => $list->id]) }}" role="button">Bewerken</a>
                            <a class="btn btn-danger" href="{{ route('admin.delete', ['id' => $list->id]) }}" role="button">Verwijderen</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
