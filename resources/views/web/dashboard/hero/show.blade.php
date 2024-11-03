@extends('web.dashboard.app', ['page' => 'hero'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Banner Images</h4>
                <p class="card-description">Upload and manage your hero and sidebar images.</p>

             
                <div class="row">
                   
                    <div class="col-md-6 mb-4">
                        <form action="{{ route('dashboard.banner.store') }}" enctype="multipart/form-data" method="post"
                            class="p-3 border border-1 rounded">
                            @csrf
                            <input type="hidden" name="form_type" value="slider1">
                            <label for="banner_slider2" class="mb-1 font-weight-bold">Upload Sidebar Slider Image 1:</label>
                            <div class="input-group mb-3">
                                <input type="file" name="banner_slider" id="banner_slider2" class="form-control"
                                    onchange="previewImage(event, 'slider1Preview')">
                               
                        </div>
                        <div >
                            @if ($errors->has('banner_slider'))
                            <div class="text-danger">{{ $errors->first('banner_slider') }}</div>
                        @enderror
                        </div>
                        <img id="slider1Preview" class="img-fluid d-none mb-3"
                            style="max-width: 100%; height: auto; object-fit: cover;">
                        <button type="submit" class="btn btn-primary btn-block">Upload</button>
                    </form>
                </div>

               
                <div class="col-md-6 mb-4">
                    <form action="{{ route('dashboard.banner.store.sliders') }}" enctype="multipart/form-data"
                        method="post" class="p-3 border border-1 rounded">
                        @csrf
                       
                        <label for="banner_slider3" class="mb-1 font-weight-bold">Upload Sidebar Slider Image 2:</label>
                        <div class="input-group mb-3">
                            <input type="file" name="banner_sliders" id="banner_slider3" class="form-control"
                                onchange="previewImage(event, 'slider2Preview')">
                           
                    </div>
                    <div >
                        @if ($errors->has('banner_sliders'))
                        <div class="text-danger">{{ $errors->first('banner_sliders') }}</div>
                    @enderror
                    </div>
                    <img id="slider2Preview" class="img-fluid d-none mb-3"
                        style="max-width: 100%; height:100px; object-fit: cover;">
                    <button type="submit" class="btn btn-primary btn-block">Upload</button>
                </form>
            </div>
        </div>

        <hr class="mt-3 border-2 border-dark">

        <div class="row mt-5">
          
            <div class="col-md-6 mb-4">
                <h6>Uploaded Sidebar Slider Image 1</h6>
                <table id="csidebar-slider1-table"
                    class="table table-striped table-bordered table-hover align-middle">
                    <thead >
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slider as $d)
                            @if ($d->type == 'slide1')
                                <tr>
                                    <td>
                                        <img src="{{ asset($d->image_path) }}" alt="Slider Image"
                                            class="img-fluid rounded"
                                            style="max-width: 120px; height: 56px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <form action="{{ route('dashboard.banner.destroy', $d->id) }}"
                                            method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table 2: Uploaded Sidebar Slider Image 2 -->
            <div class="col-md-6 mb-4">
                <h6>Uploaded Sidebar Slider Image 2</h6>
                <table id="bsidebar-slider2-table"
                    class="table table-striped table-bordered table-hover align-middle">
                    <thead >
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slider as $d)
                            @if ($d->type == 'slide2')
                                <tr>
                                    <td>
                                        <img src="{{ asset($d->image_path) }}" alt="Slider Image"
                                            class="img-fluid rounded"
                                            style="max-width: 120px; height:60px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <form action="{{ route('dashboard.banner.slider.delete', $d->id) }}"
                                            method="post" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#sidebar-slider1-table').DataTable();
        $('#sidebar-slider2-table').DataTable();
    });

    function previewImage(event, previewId) {
        const input = event.target;
        const reader = new FileReader();
        const imagePreview = document.getElementById(previewId);

        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.classList.remove('d-none');
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection
