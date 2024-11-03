@extends('web.dashboard.app')
@section('content')
    <div class="container my-5 form-container">
        <form action="{{route('about.store')}}" method="POST" id="aboutForm">
            @csrf
            {{-- <input type="hidden" name="type" value="{{ $type }}"> --}}

            <div class="mb-3">
                <label for="summernoteMetaDescription" class="form-label">About</label>
                <textarea id="summernoteMetaDescription" class="form-control" name="about">
                    {{ $about->about ?? '' }}
                </textarea>

            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
                    $('#summernoteMetaDescription').summernote({
                        height: 300,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });

                    // Form validation
                    $('#aboutForm').on('submit', function(e) {
                        const content = $('#summernoteMetaDescription').val().trim();
                        if (content === '') {
                            e.preventDefault(); 
                            alert('Please enter a description.'); 
                            $('#summernoteMetaDescription').summernote('focus'); 
                        }
                    });

                });
    </script>
@endsection
