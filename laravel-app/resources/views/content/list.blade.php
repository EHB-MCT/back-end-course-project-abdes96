@extends('layouts.master')
@include('partials.header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card bg-info">
                    <div class="card-header text-center">
                        <h1 class="text-white">Vragenlijst</h1>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">{{ $list->title }}</h2>
                        <h5 class="text-center">{{ $list->description }}</h5>
                        @if($list->client)
                            <h6 class="card-text">{{ $list->client }}</h6>
                        @endif
                        <h3>Vragen:</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ $errors->first('answers.*') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ route('answer', ['id' => $list->id]) }}">
                            @csrf
                            @foreach ($list->questions as $question)
                                <div class="form-group">
                                    <label for="question{{ $question->id }}" class="text-white">{{ $question->question }}</label>
                                    <div class="range-slider">
                                        <input type="range" class="form-range" name="answers[{{ $question->id }}]" id="question{{ $question->id }}" min="1" max="10">
                                        <p class="score bigger-score" id="score{{ $question->id }}">6</p>
                                    </div>
                                </div>
                            @endforeach


                            <input type="hidden" name="list_id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-primary btn-lg d-block mx-auto mt-5">Stuur</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div> <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[name^="answers["]');

            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    const questionId = input.id.replace('question', '');
                    const scoreSpan = document.getElementById(`score${questionId}`);
                    const score = parseInt(input.value) || 0;
                    scoreSpan.textContent = score;
                });
            });
        });
    </script>
@endsection

@section('scripts')

@endsection
