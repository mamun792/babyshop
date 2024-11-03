

@extends('web.frontend.master')

@section('main-content')

{{-- <section class="section-padding">
    <div class="container pt-25">
        <div class="row">
            <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
               {!! $about->about !!}
            </div>
            
        </div>
    </div>
</section> --}}

<section class="section-padding">
    <div class="container pt-25">
        <div class="row">
            <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                @if(!empty($about->about))
                    {!! $about->about !!}
                @else
                    <p>No content available.</p>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection