<div>
    @extends('web.dashboard.app', ['page' => 'Testimonial'])
    @section('content')
        {{-- @include('web.dashboard.components.cards') --}}

        <!-- Just Card -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">List of Testimonials</h3>
                        </div>
                        <div class="card-body">
                            <div class="container mt-3">
                                <!-- DataTable -->
                                <table id="testimonialTable" class="table table-striped table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th><input type="checkbox"></th>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>2</td>
                                            <td><img src="https://via.placeholder.com/50" alt="Profile Pic"
                                                    class="rounded-circle"></td>
                                            <td>Wyatt Mayer</td>
                                            <td>Chief Operation</td>
                                            <td><span class="badge bg-success">Publish</span></td>
                                            <td class="align-middle">
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-secondary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-info btn-sm toggleButton" type="button"
                                                        data-bs-target="#collapseExample1">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="collapse" id="collapseExample1">
                                            <td colspan="7">
                                                <div class="card card-body">
                                                    This is the collapsible content. It is hidden by default.
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" value="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" value="Designation" id="designation"
                                    name="designation">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3">Message</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option selected>Choose...</option>
                                    <option value="1">Publish</option>
                                    <option value="2">Unpublish</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script>
            // Initialize DataTable
            $(document).ready(function() {
                $('#testimonialTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "info": true,
                    "lengthChange": false,
                    "pageLength": 5,
                    "autoWidth": false,
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 6]
                    }]
                });
            });

            // Toggle Button Script
            document.querySelectorAll('.toggleButton').forEach(button => {
                button.addEventListener('click', function() {
                    var collapseElement = document.querySelector(this.getAttribute('data-bs-target'));
                    var bsCollapse = new bootstrap.Collapse(collapseElement, {
                        toggle: true
                    });
                });
            });
        </script>
    @endsection

</div>
