@extends('web.dashboard.app', ['page' => 'invoices'])







@section('content')

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .printable-area, .printable-area * {
            visibility: visible;
        }
        .printable-area {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>


<div class="container my-5">
    <div class="col-md-4  d-flex align-items-center">
        <a href="{{ route('dashboard.orders.index') }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="card border-light shadow-sm printable-area mt-3">
        <div class="card-header text-center bg-light border-bottom">
            <div class="row align-items-center">
                {{--  back option --}}
                
                <div class="d-flex align-items-center">
                    <img src="{{ asset(logo()) }}" alt="{{ env('APP_NAME') }}" class="img-fluid me-3" style="max-width: 100px; height: auto;">
                    <div>
                        <h5 class="mb-1 font-weight-bold text-primary" style="font-size: 1.5rem;">{{ env('APP_NAME') }}</h5>
                        <p class="mb-0 text-center" style="font-size: 0.9rem;">Address<br>Contact Info</p>
                    </div>
                </div>
                
                <div class="col-md-8 text-md-right">
                    <h6 class="font-weight-bold mt-1" style="font-size: 1.25rem;">Invoice #{{ $order->invoice_number }}</h6>
                    <p class="text-muted" style="font-size: 0.9rem;">Date: {{ $order->created_at->format('F j, Y') }}</p>
                    <p style="font-size: 0.9rem;">{{ $order->billing_address }}</p>
                    <p style="font-size: 0.9rem;">{{ $order->billing_contact }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                   
                    <button class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print"></i> Print Invoice
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Products</th>
                        <th>SKU</th>
                        <th>Attribute</th>
                        <th>Quantity</th>
                        
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->product_code }}</td>
                            <td>
                                @if ($item->options->isNotEmpty())
                                    @php
                                        $color = $item->options->firstWhere('attribute_id', 2)?->name; // Assuming attribute_id 2 is for color
                                        $size = $item->options->firstWhere('attribute_id', 1)?->name; // Assuming attribute_id 1 is for size
                                    @endphp
                            
                                    <span class="text-muted">
                                        @if ($color && $size)
                                            Color: {{ $color }}, Size: {{ $size }}
                                        @elseif ($color)
                                            Color: {{ $color }}
                                        @elseif ($size)
                                            Size: {{ $size }}
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </span>
                                @else
                                    <span class="text-muted">--</span>
                                @endif
                            </td>
                            
                            
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                      
                    <tr class="font-weight-bold bg-primary text-white">
                        <td colspan="4" class="text-right">Total Amount</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                 
                </tbody>
            </table>
        </div>

        <div class="card-footer text-center">
            <p class="mb-1">Thank you for your business!</p>
            <p class="small text-muted">Please pay within 30 days.</p>
        </div>
    </div>
</div>


@endsection