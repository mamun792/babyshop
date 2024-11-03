@extends('web.dashboard.app', ['page' => 'Brands'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}

    <div class="col-lg-12">
        <div class="card container mx-auto">
            <div class="card-header">
                <h5 class="card-title mb-0">Table</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table class="table">

                        <tbody>

                            <tr>
                                <td>
                                    <input type="text" name="company" class="form-control" placeholder="Write Brand Name">
                                    @if ($errors->has('company'))
                                        <span class="text-danger">{{ $errors->first('company') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="file" name="photo" class="form-control">
                                    @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    @endif


                                </td>
                                <td>
                                    <button class="btn  btn-sm btn-success-600 radius-8">Upload</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </form>


                <div class="table-responsive mt-5 w-50 mx-auto">
                    <table class="table striped-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Items</th>
                              

                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $d)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($d->path) }}" width="80px" alt=""
                                                class="flex-shrink-0 me-12 radius-8 me-12">
                                            <div class="flex-grow-1">
                                                <h6 class="text-xl mb-0 fw-normal">{{ $d->company }}</h6>
                                                {{-- <span class="text-sm text-secondary-light fw-normal">Fashion</span> --}}
                                            </div>
                                        </div>
                                    </td>
                         

                                    <td class="text-center">
                                        <div class="d-flex flex-wrap align-items-end gap-3 float-end">
                                            <button type="button" class="">

                                            </button>


                                            <form action="{{ route('dashboard.brand.destroy', $d->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="btn btn-outline-danger-600 radius-8 px-15 py-8 d-flex align-items-center gap-2">
                                                    <iconify-icon icon="mdi:delete" class="float-end"></iconify-icon>
                                                </button>
                                            </form>


                                            <a href="{{ route('dashboard.brand.edit', $d->id) }}"
                                                class="btn btn-success-600 radius-8 px-8 py-4 d-flex align-items-center gap-2">
                                                <iconify-icon icon="mdi:pencil" style="font-size: 24px;"></iconify-icon>


                                            </a>
                                    <td>




                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- card end -->
    </div>
@endsection
