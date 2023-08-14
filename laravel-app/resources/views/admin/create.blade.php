
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
                        <div id="formErrors">

                        @include('partials.error')
                        </div>

                        <form method="post" action="{{ route('ListAction') }}" id="listCreateForm">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Beschrijving lijst</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter description">
                            </div>
                            <div class="form-group">
                                <label for="name">Klant naam (voor prive lijst)</label>
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
                                    <input type="text" class="form-control" name="questions[]" placeholder="Enter question">
                                </div>
                            @endfor

                            @csrf
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                            <button type="button" class="btn btn-secondary" id="previewBtn">Preview</button>
                        </form>
                    </div>
                </div>

        </div>
    </div>
        <div class="modal " id="previewModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Vragenlijst</h5>
                        <button type="button" class="close" id="closePreviewModal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="previewContent">
                        <!-- Preview  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closePreviewBtn">Close</button>
                    </div>
                </div>
            </div>
        </div>




        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOMContentLoaded');

                const previewBtn = document.getElementById('previewBtn');
                const closePreviewBtn = document.getElementById('closePreviewBtn');
                const closePreviewModal = document.getElementById('closePreviewModal');
                const previewModal = document.getElementById('previewModal');
                const previewContent = document.getElementById('previewContent');
                const form = document.getElementById('listCreateForm');


                function displayErrors(errors) {
                    let errorHtml = '';
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorHtml += '<div class="alert alert-danger">' + errors[key] + '</div>';
                        }
                    }

                    const errorContainer = document.getElementById('formErrors');
                    errorContainer.innerHTML = errorHtml;
                }

                function loadPreview() {
                    console.log('loadPreview');
                    const previewUrl = '{{ route("admin.listPreview") }}';
                    // Get form data
                    const formData = new FormData(form);

                    fetch(previewUrl, {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.errors) {
                                console.log('Validation errors:', data.errors);
                                displayErrors(data.errors);
                            } else {
                                previewContent.innerHTML = data.previewHtml;
                                $(previewModal).modal('show');
                            }
                        })
                        .catch(error => {
                            console.error('Error loading preview:', error);
                        });
                }

                previewBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    loadPreview();
                });

                closePreviewBtn.addEventListener('click', function() {
                    $(previewModal).modal('hide');
                });

                closePreviewModal.addEventListener('click', function() {
                    $(previewModal).modal('hide');
                });
            });

        </script>

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
