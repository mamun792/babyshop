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
                    <div class="row">
                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Product Code</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Invoice</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Phone</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Status</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Days</span>
                                <input type="text" class="form-control" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>

                        <div class="col-2 row">
                            <div class="col-12">
                                <div class="input-group input-group-sm mb-3">
                                    {{-- <span class="input-group-text" id="inputGroup-sizing-sm">Status</span> --}}

                                    <span class="input-group-text" id="inputGroup-sizing-sm">From:</span>
                                    <input type="date" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">To:</span>
                                    <input type="date" class="form-control" aria-label="Sizing example input"
                                        aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">


                        </div>
                        <div class="col-4 ms-auto">

                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <li><a class="dropdown-item" href="#">Print table</a></li>
                                    <li><a class="dropdown-item" href="#">Print Invoice(s)</a></li>

                                    <li><a class="dropdown-item" href="#">Bulk Delete</a></li>
                                    <li><a class="dropdown-item" href="#">Bulk Invoice</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th> Invoice No. </th>
                                <th> Name </th>
                                <th> Address </th>
                                <th> Phone </th>
                                <th> Total </th>
                                <th> Status </th>
                                <th> Comment </th>
                                <th> Courier </th>
                                <th> Action </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>002</td>
                                <td>Jane Smith</td>
                                <td>456 Elm St</td>
                                <td>(555) 987-6543</td>
                                <td>$150.00</td>
                                <td>Pending</td>
                                <td>Call before delivery</td>
                                <td>FedEx</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>Bob Johnson</td>
                                <td>789 Oak St</td>
                                <td>(555) 456-7890</td>
                                <td>$200.00</td>
                                <td>Shipped</td>
                                <td>Leave at front door</td>
                                <td>DHL</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
