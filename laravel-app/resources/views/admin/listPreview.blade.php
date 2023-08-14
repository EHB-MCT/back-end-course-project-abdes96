@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <h1 class="text-white">Preview Vragenlijst</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">{{ old('title', $list['title']) }}</h2>
                        <h5 class="text-center">{{ old('description', $list['description']) }}</h5>
                        @if ($list['client'])
                            <h6 class="card-text">{{ old('client', $list['client']) }}</h6>
                        @endif
                        <h3>Vragen:</h3>
                        <form>
                            @foreach ($list['questions'] as $question)
                                <div class="form-group">
                                    <label class="text-white">{{ $question }}</label>
                                    <div class="range-slider">
                                        <input type="range" class="form-range" min="1" max="10" disabled>
                                        <p class="score bigger-score">6</p>
                                    </div>
                                </div>
                            @endforeach
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
