@extends('layouts.master')
@include('partials.admin-header')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <a href="{{ route('admin.index') }}" class="btn btn-primary mt-3">Terug</a>

            <h1>{{ $list->title }}</h1>
            <p>{{ $list->description }}</p>

            <h2>Vragen</h2>
            <ul>
                @foreach ($list->questions as $question)
                    <li>
                        {{ $question->question }} - Score: {{ $question->score }}
                    </li>
                @endforeach
            </ul>

            <h2>Statistieken</h2>
            <canvas id="chart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @if ($list->list_type === 'multiple')
        var scores = @json($list->questions->map(function ($question) {
        return $question->answers->avg('answer');
    })->toArray());
        @else
        var scores = @json($list->questions->pluck('score'));
        @endif

        var averageScore = scores.reduce(function (total, score) {
            return total + score;
        }, 0) / scores.length;

        var labels = @json($list->questions->pluck('question'));
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Scores',
                    data: scores,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                var datasetLabel = context.dataset.label || '';
                                var value = context.parsed.y;
                                if (datasetLabel === 'Scores') {
                                    return datasetLabel + ': ' + value;
                                }
                                if (datasetLabel === 'Average') {
                                    return datasetLabel + ': ' + averageScore;
                                }
                                return '';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
