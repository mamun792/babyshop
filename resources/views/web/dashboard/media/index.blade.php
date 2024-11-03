<div>
    @extends('web.dashboard.app', ['page' => 'Media'])


    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}




        <div class="container my-5">
            <div class="row">
                <!-- Media Card -->
                {{-- <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Media Management</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <!-- Logo Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Logo</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="logoPreview" src="path/to/logo.png" alt="Logo"
                                                    class="img-fluid">
                                            </div>
                                            <div class="form-group">
                                                <label for="logoUpload" class="form-label">Upload Logo</label>
                                                <input type="file" class="form-control" id="logoUpload">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Favicon Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Favicon</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="faviconPreview" src="path/to/favicon.ico" alt="Favicon"
                                                    class="img-fluid" style="max-width: 50px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="faviconUpload" class="form-label">Upload Favicon</label>
                                                <input type="file" class="form-control" id="faviconUpload">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Loader Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Loader</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="loaderPreview" src="path/to/loader.gif" alt="Loader"
                                                    class="img-fluid">
                                            </div>
                                            <div class="form-group">
                                                <label for="loaderUpload" class="form-label">Upload Loader</label>
                                                <input type="file" class="form-control" id="loaderUpload">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer Image Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Footer Image</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="footerImagePreview" src="path/to/footer_image.png"
                                                    alt="Footer Image" class="img-fluid">
                                            </div>
                                            <div class="form-group">
                                                <label for="footerImageUpload" class="form-label">Upload Footer
                                                    Image</label>
                                                <input type="file" class="form-control" id="footerImageUpload">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Other Images Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Other Images</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="otherImagesPreview1" src="path/to/other_image1.png"
                                                    alt="Other Image 1" class="img-fluid">
                                                <img id="otherImagesPreview2" src="path/to/other_image2.png"
                                                    alt="Other Image 2" class="img-fluid">
                                            </div>
                                            <div class="form-group">
                                                <label for="otherImagesUpload" class="form-label">Upload Other
                                                    Images</label>
                                                <input type="file" class="form-control" id="otherImagesUpload" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}

                <div class="container mt-5">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header ">
                                <h5 class="card-title mb-0">Media Management</h5>
                            </div>
                            {{-- error all --}}

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                            @endif




                            <div class="card-body">
                                <form id="mediaForm" action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- Logo Section -->
                                        <div class="col-md-6 mb-4">
                                            <div class="border rounded p-3 bg-light">
                                                <h6 class="mb-3">Logo</h6>
                                                <div class="media-preview mb-3 text-center">
                                                    <img id="logoPreview" src="{{ asset('path/to/logo.png') }}" alt="Logo" class="img-fluid">
                                                </div>
                                                <div class="form-group">
                                                    <label for="logoUpload" class="form-label">Upload Logo</label>
                                                    <input type="file" name="logo" class="form-control" id="logoUpload" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Favicon Section -->
                                         <!-- Favicon Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Favicon</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="faviconPreview" src="path/to/favicon.ico" alt="Favicon"
                                                    class="img-fluid" style="max-width: 50px;">
                                            </div>
                                            <div class="form-group">
                                                <label for="faviconUpload" class="form-label">Upload Favicon</label>
                                                <input type="file" class="form-control" name="favicon" id="faviconUpload">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">   
                                    <!-- Loader Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Loader</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="loaderPreview" src="path/to/loader.gif" alt="Loader"
                                                    class="img-fluid">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label for="loaderUpload" class="form-label">Upload Loader</label>
                                                <input type="file" name="loader" class="form-control" id="loaderUpload" accept="image/*">
                                            </div>

                                        </div>
                                    </div>
                                    <!-- Footer Image Section -->
                                    <div class="col-md-6 mb-4">
                                        <div class="border rounded p-3 bg-light">
                                            <h6 class="mb-3">Footer Image</h6>
                                            <div class="media-preview mb-3 text-center">
                                                <img id="footerImagePreview" src="path/to/footer_image.png"
                                                    alt="Footer Image" class="img-fluid">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label for="footerImageUpload" class="form-label">Upload Footer
                                                    Image</label>
                                                <input type="file" name="footer_image" class="form-control" id="footerImageUpload" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                               
                                    {{-- <div class="row">
                                        <!-- Other Images Section -->
                                        <div class="col-md-6 mb-4">
                                            <div class="border rounded p-3 bg-light">
                                                <h6 class="mb-3">Other Images</h6>
                                                <div class="media-preview mb-3 text-center">
                                                    <img id="otherImagesPreview1" src="path/to/other_image1.png"
                                                        alt="Other Image 1" class="img-fluid">
                                                    <img id="otherImagesPreview2" src="path/to/other_image2.png"
                                                        alt="Other Image 2" class="img-fluid">
                                                </div>
                                                <div class="form-group">
                                                    <label for="otherImagesUpload" class="form-label">Upload Other
                                                        Images</label>
                                                    <input type="file" class="form-control" id="otherImagesUpload" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}



                                      
                                    </div>
                                    <!-- Submit Button -->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                


            </div>
        </div>
    @endsection
    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const fileInputs = document.querySelectorAll('input[type="file"]');

                fileInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        const file = this.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewId = input.id.replace('Upload', 'Preview');
                                const preview = document.getElementById(previewId);
                                if (preview) {
                                    preview.src = e.target.result;
                                }
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                });
            });
        </script>

     
    @endsection
</div>
