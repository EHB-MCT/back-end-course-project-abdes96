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
                                <label for="description">Beschrijving lijst</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter description">
                            </div>
                            <div class="form-group">
                                <label for="description">Klant naam (voor prive lijst) </label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Clients name">
                            </div>
                            <div class="form-group">
                                <label for="list_type">List Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="list_type" value="single">
                                    <label class="form-check-label" for="list_type">Prive lijst</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="list_type" value="multiple" checked>
                                    <label class="form-check-label" for="list_type">Public lijst</label>
                                </div>
                            </div>
                            <h3>Questions</h3>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="form-group">
                                    <label for="question{{ $i }}">Vraag {{ $i }}</label>
                                    <input type="text" class="form-control" name="questions[]" placeholder="Enter question" >
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

@push('scripts')
    @if(session('listCreated'))
        <script>
            var listId = "{{ session('listCreated') }}";
            var listUrl = "{{ route('lists', ['id' => '']) }}";
            var listShowUrl = listUrl + "/" + listId;
            alert("List created successfully!\n\nYou can access the list here:\n" + listShowUrl);
        </script>
    @endif
@endpush
