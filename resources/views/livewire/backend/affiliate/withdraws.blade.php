<div>
    <div class="container mt-5">
        <div class="row">


            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Payment request</h5>


                        <div class="table-responsive">
                            <table class="table bordered-table mb-0 ">
                                <thead>
                                    <tr>

                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>Account information</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        function formatPaymentMethodKey($key)
                                        {
                                            return ucwords(str_replace('_', ' ', $key));
                                        }
                                    @endphp
                                    @foreach ($payments as $p)
                                        <tr>

                                            <td>
                                                {{ $p->created_at->format('m D Y H:i A') }}
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>{{ $p->user->name }}</li>
                                                    <li>{{ $p->user->phone }}</li>
                                                    <li>{{ $p->user->street_address }}</li>
                                                </ul>
                                                
                                            </td>
                                            <td>
                                                {{ $p->amount }}
                                            </td>

                                            <td>
                                                <ul>
                                                    @foreach ($p->payment_method as $key => $value)
                                                        <li><strong>{{ formatPaymentMethodKey($key) }} : </strong> <span
                                                                class="text-success">{{ $value }}</span></li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    <!-- Select dropdown for commission type -->
                                                    <select
                                                        wire:change="statusUpdate({{ $p->id }}, $event.target.value)"
                                                        class="form-control" name="commission_type">
                                                        <option value="unpaid" {{ $p->status == 'unpaid' ? 'selected' : '' }}>
                                                            Unpaid</option>
                                                        <option value="paid" {{ $p->status == 'paid' ? 'selected' : '' }}>
                                                            Paid</option>
                                                        <option value="rejected"
                                                            {{ $p->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
