
    $(document).ready(function () {
      $('#sizeSelect').on('change', function () {
        // Perform some action when an option is selected
        var selectedValue = $(this).val();
        console.log('Selected Size: ' + selectedValue);
      });
    });



  let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = $(".mySlides");
    let dots = $(".demo");
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    slides.hide(); // Hides all slides
    dots.removeClass("active"); // Removes 'active' class from all dots
    $(slides[slideIndex - 1]).show(); // Shows the current slide
    $(dots[slideIndex - 1]).addClass("active"); // Adds 'active' class to the current dot
}


    $(document).ready(function () {
      $('.color-ball').on('click', function () {
        $('.color-ball').removeClass('active');
        $(this).addClass('active');
        $('#colorName').text($(this).data('color'));
      });
    });

    $(document).ready(function () {
      $('.add-favourite a').on('click', function (e) {
        e.preventDefault();
        $(this).find('svg').toggleClass('active');
      });
    });

    const readMoreBtn = document.getElementById('readMoreBtn');
    const content = document.getElementById('product-content');

    readMoreBtn.addEventListener('click', () => {
      content.classList.toggle('expanded');
      if (content.classList.contains('expanded')) {
        readMoreBtn.textContent = 'Read Less';
      } else {
        readMoreBtn.textContent = 'Read More';
      }
    });
 

    
// category slider section start
    
var swiper = new Swiper(".productDetailsSwiper", {
  spaceBetween: 10,
  centeredSlides: true,
  slidesPerView: 7,
  loop: true,
  speed: 1000,
  autoplay: false,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
      640: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 5,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 7,
        spaceBetween: 20,
      },
    },
});
// category slider section start
