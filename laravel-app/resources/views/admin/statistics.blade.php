@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="jumbotron">
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
        var scores = @json($list->questions->pluck('score'));
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
                }
            }
        });
    </script>
@endsection
