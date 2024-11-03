@extends('web.dashboard.app', ['page' => 'hero'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}




    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hero Images</h4>
                <p class="card-description">Upload and manage your hero images.</p>

                <!-- Row for the upload form -->
                <div class="row mb-12">
                    <div class="col-md-6 mx-auto">
                        <form action="{{ route('dashboard.hero.store') }}" enctype="multipart/form-data" method="post"
                            class="p-4 border border-1 rounded">
                            @csrf
                            <div class="form-group">
                                <label for="banner_slider1" class="mb-2 font-weight-bold">Upload Hero Image:</label>
                                <div class="input-group">
                                    <input type="file" name="banner_slider" id="banner_slider1" class="form-control"
                                        onchange="previewImage(event)">
                                </div>
                                @if ($errors->has('banner_slider'))
                                    <div class="text-danger">{{ $errors->first('banner_slider') }}</div>
                                @enderror
                        </div>

                        <div class="form-group mt-3">
                            <img id="imagePreview" class="img-fluid d-none"
                                style="max-width: 100%; height: auto; object-fit: cover;">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Upload Image</button>
                    </form>

                    <!-- Success/Error feedback -->
                    @if (session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </div>
            </div>

            <!-- Table displaying uploaded images -->
            <div class="row">

                <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                    <div class="row gy-4">
                        @foreach ($data as $d)
                        <div class="col-xxl-3 col-md-4 col-sm-6">
                            <div class="hover-scale-img border radius-16 overflow-hidden">
                                <div class="max-h-266-px overflow-hidden">
                                    <img src="{{ asset($d->image_path) }}" alt="" class="hover-scale-img__img w-100 h-100 object-fit-cover">
                                </div>
                           
                                    <form action="{{ route('dashboard.hero.destroy', $d->id) }}" method="post"
                                        class="btn btn-danger btn-sm w-100">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="" title="Delete">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                               
                            </div>
                        </div>
               @endforeach
                        
                    </div>
                </div>














           
            </div>


        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#hero-table').DataTable({
            "responsive": true,
            "autoWidth": false
        });
    });

    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        const imagePreview = document.getElementById('imagePreview');

        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.classList.remove('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection
