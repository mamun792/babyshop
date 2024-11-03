@extends('web.dashboard.app', ['page' => 'Brands'])







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}


    <div class="row">



        <div class="col-lg-6 mx-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    {{-- <p class="card-description"> Add class <code>.table-striped</code> --}}
                    </p>

                    <form action="{{ route('dashboard.brand.update', $brand->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> File </th>
                                    <th> Action </th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>
                                        <input type="text" name="company" value="{{ $brand->company }}"
                                            class="form-control">
                                        @if ($errors->has('company'))
                                            <span class="text-danger">{{ $errors->first('company') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="file" name="photo" class="form-control">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Update</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <img src="{{ asset($brand->path) }}">
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
