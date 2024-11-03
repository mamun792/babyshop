<section class="section-padding" style="margin-top: -20px !important">
    <div class="container pb-20">
        <div class="row">

            {{-- @foreach ($campaigns_product as $product)

         


                <div class="col-md-6 p-4">
                    <div class="row d-flex align-items-center justify-content-center"
                        style="border: 2px solid #088178; border-radius: 10px; padding: 20px"
                        data-start-date="{{ $campaign->start_date }}" data-end-date="{{ $campaign->expiry_date }}">

                        <div class="col-md-4">
                            <img src="{{ asset($product->featured_image) }}" class="img-fluid"
                                style="border-radius: 15px" />
                        </div>

                        <div class="col-md-8">
                            <div>
                                <h4>{{ $product->name }}</h4>
                                <br>

                                <div
                                    style="font-family: 'Spartan', sans-serif; display: flex; align-items: center; justify-content: flex-start; gap: 13px">

                                    <span
                                        style="color: red"><strong>{{ $product->price - $product->discount_price - $product->campaign_price }}Tk.</strong></span>
                                    <span><strong><del>{{ $product->price - $product->discount_price }}</del></strong>Tk.</span>
                                    <span><strong>{{ $product->campaign_price }}Tk. off</strong></span>
                                </div>

                                <div class="fw-bold"
                                    style="font-family: 'Spartan', sans-serif; font-size: 15px; display: flex; align-items:center; justify-content: flex-start; gap: 10px">
                                    Already sold : {{ $product->sold }}
                                    <span>Available : {{ $product->quantity - $product->sold }}</span>
                                </div>

                                <div class="d-flex align-items-center justify-content-start mt-2 fw-bold"
                                    style="gap: 15px; font-size: 17px">
                                    <span>Code: {{ $campaign->code }}</span>
                                    <span class="sr-only">{{ $campaign->start_date }}</span>
                                    <span class="sr-only">{{ $campaign->expiry_date }}</span>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress mt-5">
                                <div class="progress-bar  progress-bar-striped" style="width:0%; background: #046963">
                                </div>
                            </div>

                            <!-- Countdown timer display -->
                            <div class="d-flex align-items-center justify-content-start mt-3 timer-block">
                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                    <span class="days" style="font-weight: bold; font-size: 25px">00</span>
                                    <span style="font-weight: bold">Days</span>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                    <span class="hours" style="font-weight: bold; font-size: 25px">00</span>
                                    <span style="font-weight: bold">Hours</span>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                    <span class="minutes" style="font-weight: bold; font-size: 25px">00</span>
                                    <span style="font-weight: bold">Minutes</span>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                    <span class="seconds" style="font-weight: bold; font-size: 25px">00</span>
                                    <span style="font-weight: bold">Seconds</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach --}}

            <div class="glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($campaigns_product as $product)
                            <li class="glide__slide">
                                <div class="col-md-12 p-4">
                                    <div class="row d-flex align-items-center justify-content-center"
                                        style="border: 2px solid #088178; border-radius: 10px; padding: 20px"
                                        data-start-date="{{ $campaign->start_date }}"
                                        data-end-date="{{ $campaign->expiry_date }}">
            
                                        <div class="col-md-4">
                                            <img src="{{ asset($product->featured_image) }}" class="img-fluid"
                                                style="border-radius: 15px" />
                                        </div>
            
                                        <div class="col-md-8">
                                            <h4>{{ $product->name }}</h4>
                                            <br>
                                            <div style="font-family: 'Spartan', sans-serif; display: flex; align-items: center; justify-content: flex-start; gap: 13px">
                                                <span style="color: red"><strong>{{ $product->price - $product->discount_price - $product->campaign_price }}Tk.</strong></span>
                                                <span><strong><del>{{ $product->price - $product->discount_price }}</del></strong>Tk.</span>
                                                <span><strong>{{ $product->campaign_price }}Tk. off</strong></span>
                                            </div>
                                            <div class="fw-bold" style="font-family: 'Spartan', sans-serif; font-size: 15px; display: flex; align-items:center; justify-content: flex-start; gap: 10px">
                                                Already sold: {{ $product->sold }}
                                                <span>Available: {{ $product->quantity - $product->sold }}</span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-start mt-2 fw-bold" style="gap: 15px; font-size: 17px">
                                                <span>Code: {{ $campaign->code }}</span>
                                                <span class="sr-only">{{ $campaign->start_date }}</span>
                                                <span class="sr-only">{{ $campaign->expiry_date }}</span>
                                            </div>
            
                                            <!-- Progress Bar -->
                                            <div class="progress mt-5">
                                                <div class="progress-bar progress-bar-striped" style="width:0%; background: #046963"></div>
                                            </div>
            
                                            <!-- Countdown timer display -->
                                            <div class="d-flex align-items-center justify-content-start mt-3 timer-block">
                                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                                    <span class="days" style="font-weight: bold; font-size: 25px">00</span>
                                                    <span style="font-weight: bold">Days</span>
                                                </div>
                                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                                    <span class="hours" style="font-weight: bold; font-size: 25px">00</span>
                                                    <span style="font-weight: bold">Hours</span>
                                                </div>
                                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                                    <span class="minutes" style="font-weight: bold; font-size: 25px">00</span>
                                                    <span style="font-weight: bold">Minutes</span>
                                                </div>
                                                <div class="d-flex flex-column align-items-center justify-content-center p-2 time-box">
                                                    <span class="seconds" style="font-weight: bold; font-size: 25px">00</span>
                                                    <span style="font-weight: bold">Seconds</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            
                {{-- <div class="glide__arrows" data-glide-el="controls">
                    <!-- Left arrow -->
                    <button class="glide__arrow glide__arrow--left btn btn-light rounded-circle p-1 position-absolute top-50 translate-middle-y start-0 ms-5" data-glide-dir="<" style="background-color: #e8f6ea;">
                        <i class="fi-rs-angle-left"></i>
                    </button>
                    <!-- Right arrow -->
                    <button class="glide__arrow glide__arrow--right btn btn-light rounded-circle p-1 position-absolute top-50 translate-middle-y end-0 me-5" data-glide-dir=">" style="background-color: #e8f6ea;">
                        <i class="fi-rs-angle-right"></i>
                    </button>
                </div> --}}

                <div class="glide__arrows" data-glide-el="controls">
                    <!-- Left arrow -->
                    <button class="glide__arrow glide__arrow--left btn btn-light rounded-circle p-1 position-absolute top-50 translate-middle-y start-0 ms-5" data-glide-dir="<"
                        style="background-color: #e8f6ea; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#d4f0dc'; this.style.boxShadow='0px 6px 12px rgba(0, 0, 0, 0.15)';" 
                        onmouseout="this.style.backgroundColor='#e8f6ea'; this.style.boxShadow='0px 4px 8px rgba(0, 0, 0, 0.1)';">
                        <i class="fi-rs-angle-left"></i>
                    </button>
                
                    <!-- Right arrow -->
                    <button class="glide__arrow glide__arrow--right btn btn-light rounded-circle p-1 position-absolute top-50 translate-middle-y end-0 me-5" data-glide-dir=">"
                        style="background-color: #e8f6ea; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); transition: background-color 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#d4f0dc'; this.style.boxShadow='0px 6px 12px rgba(0, 0, 0, 0.15)';" 
                        onmouseout="this.style.backgroundColor='#e8f6ea'; this.style.boxShadow='0px 4px 8px rgba(0, 0, 0, 0.1)';">
                        <i class="fi-rs-angle-right"></i>
                    </button>
                </div>
                
                
            </div>
            
            

        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.querySelectorAll('.timer-block').forEach(function(timerBlock) {
            var endDate = timerBlock.closest('div[data-end-date]').getAttribute('data-end-date');
            var startDate = timerBlock.closest('div[data-start-date]').getAttribute('data-start-date');

            var countDownDate = new Date(endDate).getTime(); // Campaign end date
            var campaignStartDate = new Date(startDate).getTime(); // Campaign start date

            var totalDuration = countDownDate - campaignStartDate; // Total campaign duration

            var progressBar = timerBlock.closest('.row').querySelector('.progress-bar'); // Progress bar reference

            var countdownFunction = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                // Calculate time remaining
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Update the countdown timer in HTML
                timerBlock.querySelector('.days').innerHTML = days;
                timerBlock.querySelector('.hours').innerHTML = hours;
                timerBlock.querySelector('.minutes').innerHTML = minutes;
                timerBlock.querySelector('.seconds').innerHTML = seconds;

                // Calculate percentage of time passed for the progress bar
                var timePassed = now - campaignStartDate;
                var percentagePassed = (timePassed / totalDuration) * 100;

                // Update the progress bar width based on time passed
                if (percentagePassed > 100) {
                    percentagePassed = 100;
                }
                progressBar.style.width = percentagePassed + '%';

                // If the countdown is finished, stop the timer
                if (distance < 0) {
                    clearInterval(countdownFunction);
                    timerBlock.querySelector('.days').innerHTML = '00';
                    timerBlock.querySelector('.hours').innerHTML = '00';
                    timerBlock.querySelector('.minutes').innerHTML = '00';
                    timerBlock.querySelector('.seconds').innerHTML = '00';

                    // Ensure the progress bar is full when the countdown ends
                    progressBar.style.width = '100%';
                }
            }, 1000);
        });




        document.addEventListener('DOMContentLoaded', function() {
            new Glide('.glide', {
                type: 'carousel',
                perView: 2,

                gap: 20,
                hoverpause: true,
                autoplay: 3000,
                breakpoints: {
                    1024: {
                        perView: 1
                    },
                    600: {
                        perView: 1
                    }
                },
                // Arrows navigation setup
                arrow: true,
                prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-angle-left"></i></span>',
                nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-angle-right"></i></span>',
                appendArrows: '.glide__arrows',
            }).mount();
        });
    </script>
@endpush
