@extends('web.dashboard.app')







@section('content')
    {{-- @include('web.dashboard.components.cards') --}}


    <div class="row">



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <p class="card-description"> Add class <code>.table-striped</code>
                    </p>

                    <form action="{{ route('dashboard.attribute.store') }}" method="post" class="p-3 mb-3 border border-1">
                        <label for="" class="mb-1">Create Attribute :</label>
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <button class="btn btn-outline-dark" type="button">Create</button>
                        </div>

                    </form>


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> SL. </th>
                                <th> Name </th>
                                <th> Option </th>
                                <th> Action </th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>002</td>
                                <td>Milk</td>
                                <td>
                                    <ul>
                                        <li>Red</li>
                                        <li>Green</li>
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.attribute.option.add') }}"
                                        class="btn btn-success btn-sm">Add Option</a>

                                    <a href="{{ route('dashboard.attribute.edit', 1) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('dashboard.attribute.destroy', 1) }}" method="post">

                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>

                                </td>
                            </tr>

                            <tr>
                                <td>002</td>
                                <td>Milk</td>
                                <td>
                                    <ul>
                                        <li>Red</li>
                                        <li>Green</li>
                                    </ul>
                                </td>
                                <td>
                                    <button class="btn btn-success btn-sm">Add Option</button>

                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
