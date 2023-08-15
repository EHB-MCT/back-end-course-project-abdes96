@extends('layouts.master')
@include('partials.admin-header')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-4">Edit List</h1>
                    </div>
                    <div class="card-body">
                        <div id="formErrors">
                            @include('partials.error')
                        </div>

                        <form method="post" action="{{ route('admin.update') }}" id="listEditForm">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $list->title }}" placeholder="Enter title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ $list->description }}" placeholder="Enter description">
                            </div>
                            @if ($list->client)
                                <div class="form-group">
                                    <label for="name">Client Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $list->client }}" placeholder="Enter client name">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="list_type">List Type</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="list_type" value="single" {{ $list->list_type === 'single' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="list_type">Single User List</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="list_type" value="multiple" {{ $list->list_type === 'multiple' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="list_type">Multiple Users List</label>
                                </div>
                            </div>
                            <h3>Questions</h3>
                            <div id="questionFields">

                            @foreach($list->questions as $index => $question)
                                <div class="form-group">
                                    <label for="question{{ $index + 1 }}">Question {{ $index + 1 }}</label>
                                    <input type="text" class="form-control" name="questions[]" value="{{ $question->question }}" placeholder="Enter question">
                                </div>
                            @endforeach
                            </div>

                            @csrf
                            <button type="button" class="btn btn-secondary" id="addQuestionBtn">Add Question</button>

                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <!-- Preview button -->
                            <button type="button" class="btn btn-secondary" id="previewBtn">Preview</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="previewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview List</h5>
                    <button type="button" class="close" id="closePreviewModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="previewContent">
                    <!-- Preview content -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closePreviewBtn">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const addQuestionBtn = document.getElementById('addQuestionBtn');
            const questionFields = document.getElementById('questionFields');

            let questionCount = {{ count($list->questions) }}; // Set to the initial number of questions

            addQuestionBtn.addEventListener('click', function() {
                questionCount++;

                const newQuestionField = document.createElement('div');
                newQuestionField.classList.add('form-group');
                newQuestionField.innerHTML = `
                    <label for="question${questionCount}">Question ${questionCount}</label>
                    <input type="text" class="form-control" name="questions[]" placeholder="Enter question">
                    <button type="button" class="btn btn-danger remove-question-btn">Remove</button>
                `;

                questionFields.appendChild(newQuestionField);

                const removeQuestionBtn = newQuestionField.querySelector('.remove-question-btn');
                removeQuestionBtn.addEventListener('click', function() {
                    questionFields.removeChild(newQuestionField);
                    questionCount--;
                    updateQuestionLabels();
                });

                updateQuestionLabels();
            });

            function updateQuestionLabels() {
                const questionLabels = questionFields.querySelectorAll('label');
                questionLabels.forEach((label, index) => {
                    label.textContent = `Question ${index + 1}`;
                });
            }


            const previewBtn = document.getElementById('previewBtn');
            const closePreviewBtn = document.getElementById('closePreviewBtn');
            const closePreviewModal = document.getElementById('closePreviewModal');
            const previewModal = document.getElementById('previewModal');
            const previewContent = document.getElementById('previewContent');
            const form = document.getElementById('listEditForm');

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
