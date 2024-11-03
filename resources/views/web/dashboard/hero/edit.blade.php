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
                        <label for="" class="mb-1">Change Attribute Name:</label>
                        <input type="text" class="form-control">


                    </form>


                    <div class="input-group flex-nowrap">

                        <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                            aria-describedby="addon-wrapping">
                        <a href="{{ route('dashboard.attribute.option.edit', 1) }}" class="input-group-text"
                            id="addon-wrapping">Edit</a>
                    </div>
                    <br>
                    <button class="btn btn-outline-dark" type="button">Update</button>

                </div>
            </div>
        </div>
    </div>
@endsection
