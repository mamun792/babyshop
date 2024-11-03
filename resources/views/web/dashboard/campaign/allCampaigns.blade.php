    @extends('web.dashboard.app', ['page' => 'campaigns'])
    @section('content')
        <div class="dashboard-main-body">



            <div class="card basic-data-table">
                <div class="card-header">
                    <div class="card-title mb-0 px-24">
                        All Campaigns
                        <a href="{{ route('dashboard.campaign.index') }}" class="btn btn-success btn-sm" style="float: right;">
                            <i class="fas fa-plus"></i> Add Campaign
                        </a>

                    </div>
                    <div class="card-body">

                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th> Discount</th>

                                    <th>Code</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example static row -->

                                @foreach ($campaigns as $campaign)
                                    <tr>


                                        <td>{{ $campaign->id }}</td>
                                        <td>{{ $campaign->name }}</td>
                                        <td>{{ $campaign->start_date }}</td>
                                        <td>{{ $campaign->expiry_date }}</td>
                                        <td>{{ str_ends_with($campaign->discount, '%') ? $campaign->discount : 'BDT ' . $campaign->discount }}
                                        </td>

                                        <td>{{ $campaign->code }}</td>




                                        <td>
                                            <div class="btn-group gap-3" role="group" aria-label="Actions">
                                                <a href="{{ route('dashboard.campaign.product.code.edit', $campaign->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                {{-- <form action="{{route('dashboard.campaign.destroy', $campaign->id)}}" method="post">
                                        @csrf

                                        @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    </form> --}}

                                                <form id="delete-form-{{ $campaign->id }}"
                                                    action="{{ route('dashboard.campaign.destroy', $campaign->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $campaign->id }})">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endsection

        @section('js')
            <script>
                $(document).ready(function() {
                    $('#datatable').DataTable();
                });

                function confirmDelete(campaignId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                           
                            document.getElementById('delete-form-' + campaignId).submit();
                        }
                    });
                }
            </script>
        @endsection
