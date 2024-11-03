<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{ asset('frontend/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/hotdeal.css') }}" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">

    <style>
        /* Extra small devices (xs, <576px) */
        .container {
            max-width: 100%;
        }

        /* Small devices (sm, ≥576px) */
        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        /* Medium devices (md, ≥768px) */
        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        /* Large devices (lg, ≥992px) */
        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        /* Extra large devices (xl, ≥1200px) */
        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        /* Extra extra large devices (xxl, ≥1400px) */
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
            }
        }

    </style>


    <style>
        .glide__arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.3);
            /* Semi-transparent background */
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            z-index: 10;
        }

        .glide__arrow--left {
            left: 10px;
            /* Position on the left side */
        }

        .glide__arrow--right {
            right: 10px;
            /* Position on the right side */
        }

        .glide__arrow:hover {
            background-color: rgba(0, 0, 0, 0.4);
            /* Darken on hover */
        }

    </style>

</head>

<body>




 
    <!-- Products End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    {{-- <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script> --}}

    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('frontend/mail/contact.js') }}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function parseDateString(dateString) {
                const [day, month, year] = dateString.split('-').map(Number);
                return new Date(year, month - 1, day);
            }

            function updateCountdown(element, endTime) {
                const second = 1000
                    , minute = second * 60
                    , hour = minute * 60
                    , day = hour * 24;

                const countDownDate = parseDateString(endTime).getTime();

                const interval = setInterval(function() {
                    const now = new Date().getTime()
                        , distance = countDownDate - now;

                    let days, hours, minutes, seconds;

                    if (distance > 0) {
                        days = Math.floor(distance / day);
                        hours = Math.floor((distance % day) / hour);
                        minutes = Math.floor((distance % hour) / minute);
                        seconds = Math.floor((distance % minute) / second);
                    } else {
                        days = hours = minutes = seconds = 0;
                        clearInterval(interval);
                    }

                    // Update HTML elements within the specific countdown container
                    element.querySelector('#days').innerText = String(days).padStart(2, '0');
                    element.querySelector('#hours').innerText = String(hours).padStart(2, '0');
                    element.querySelector('#minutes').innerText = String(minutes).padStart(2, '0');
                    element.querySelector('#seconds').innerText = String(seconds).padStart(2, '0');

                    // Optional: Show a message when countdown is over
                    if (distance < 0) {
                        element.querySelector('#days').innerText = '00';
                        element.querySelector('#hours').innerText = '00';
                        element.querySelector('#minutes').innerText = '00';
                        element.querySelector('#seconds').innerText = '00';
                        clearInterval(interval);
                    }
                }, 1000);
            }

            function initializeCountdowns() {
                // Select all countdown containers
                const countdownContainers = document.querySelectorAll('#countdown');

                countdownContainers.forEach(container => {
                    // Get the end time from the timestamp element
                    const endTime = container.querySelector('.timestamp').innerText.trim();

                    // Initialize the countdown for this container
                    updateCountdown(container, endTime);
                });
            }

            // Initialize countdowns when the DOM is fully loaded
            initializeCountdowns();
        });

    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="12345"></script>

    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Glide('.glide', {
                type: 'carousel', // Or 'slider', depends on what you need
                perView: 1, // Number of visible slides
                arrows: true, // Ensures arrows are enabled
                autoplay: 3000, // Autoplay every 3000ms (3 seconds)
                hoverpause: true // Pauses autoplay on hover
            }).mount();

            new Glide('#glide1', {
                type: 'carousel'
                , perView: 1
                , autoplay: 3000, // Autoplay every 3000ms (3 seconds)
                hoverpause: true // Pauses autoplay on hover
            }).mount();

            new Glide('#glide2', {
                type: 'carousel'
                , perView: 1
                , autoplay: 3000, // Autoplay every 3000ms (3 seconds)
                hoverpause: true // Pauses autoplay on hover
            }).mount();


            new Glide('#category_glide', {
                type: 'carousel', // Use 'carousel' to allow continuous sliding
                perView: 7, // Number of slides visible at a time
                focusAt: 'center', // Center the active slide
                gap: 6, // Remove gap between slides to avoid cut-off
                autoplay: 3000, // Autoplay every 3000ms (3 seconds)
                hoverpause: true, // Pauses autoplay on hover
                //    peek: {
                //     before: -25,
                //     after: 0
                //    },
                breakpoints: {
                    1200: {
                        perView: 3
                    }
                    , 992: {
                        perView: 2
                    }
                    , 768: {
                        perView: 1
                    }
                }
            }).mount();


            new Glide('#brand_glide', {
                type: 'carousel', // Use 'carousel' to allow continuous sliding
                perView: 7, // Number of slides visible at a time
                // focusAt: 'center', // Center the active slide
                gap: 12, // Remove gap between slides to avoid cut-off
                autoplay: 3000, // Autoplay every 3000ms (3 seconds)
                hoverpause: true, // Pauses autoplay on hover
                //    peek: {
                //     before: -25,
                //     after: 0
                //    },
                breakpoints: {
                    1200: {
                        perView: 3
                    }
                    , 992: {
                        perView: 2
                    }
                    , 768: {
                        perView: 1
                    }
                }
            }).mount();




        });

    </script>
</body>

</html>
