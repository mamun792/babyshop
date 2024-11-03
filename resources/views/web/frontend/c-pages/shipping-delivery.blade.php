@extends('web.frontend.master')

@section('main-content')

<div class="container mt-5 mb-10">
    <div class="row">
        <div class="col-md-12">
            <h3>
               Shopping and Delivery
            </h3>

            @if($shoppings->isEmpty())
                <p>No data available at this time.</p>
            @else
                @foreach($shoppings as $policy)
                    <p>Effective date: {{ $policy->created_at->format('d M, Y') }}</p>
                    <p>{!! $policy->content !!}</p>
                @endforeach
            @endif
        </div>
    </div>
    <br>
</div>

@endsection
