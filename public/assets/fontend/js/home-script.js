document.addEventListener("DOMContentLoaded", function () {
  // sub nav news section start
  const txts = document.querySelector(".animate-text").children,
    txtsLen = txts.length;

  let index = 0;
  const textInTimer = 3100,
    textOutTimer = 2800;

  function animateText() {
    // Check if there are any text elements
    if (txtsLen === 0) {
      console.error("No text elements found inside .animate-text.");
      return; // Exit if no elements are found
    }

    // Remove animation classes from all text elements
    for (let i = 0; i < txtsLen; i++) {
      txts[i].classList.remove("text-in", "text-out");
    }

    // Add class to the current text element to fade in
    txts[index].classList.add("text-in");

    // Set a timeout to fade out the current text
    setTimeout(function () {
      txts[index].classList.add("text-out");
    }, textOutTimer);

    // Move to the next text element after the fade-in time
    setTimeout(function () {
      // Update index for the next text
      index = (index + 1) % txtsLen; // Loop back to the first text
      animateText(); // Recursive call to continue the animation
    }, textInTimer);
  }

  // Start animation when the DOM is fully loaded
  animateText();
});
// sub nav news section end

// sub nav news section start

// Banner slider section start
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  loop: true,
  speed: 3000,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
// Banner slider section end

// category slider section start

var swiper = new Swiper(".categorySwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  slidesPerView: 9,
  loop: true,
  speed: 1000,
  autoplay: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 4,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
    1024: {
      slidesPerView: 8,
      spaceBetween: 40,
    },
  },
});
// category slider section start

// category thumb slider section start

var swiper = new Swiper(".thumbSwiper", {
  spaceBetween: 30,
  centeredSlides: true,
  slidesPerView: 3,
  loop: true,
  speed: 1000,
  autoplay: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 40,
    },
  },
});
// category thumb slider section end

let localWishlistCount = parseInt(document.getElementById('wishlist-count')?.innerText) || 0; // Initialize local count

function toggleFavorite(element, productId) {
    const isFavorited = element.classList.contains('favorited');

    // Show spinner while processing
    const spinner = document.createElement('span');
    spinner.className = 'spinner-border spinner-border-sm'; 
    element.appendChild(spinner);
    element.style.pointerEvents = 'none'; // Disable pointer events

    // Update local count based on action
    const change = !isFavorited ? 1 : -1; // Increment if added, decrement if removed
    localWishlistCount += change;

    // Update displayed count immediately
    const wishlistCountElement = document.getElementById('wishlist-count');
    if (wishlistCountElement) {
        wishlistCountElement.innerText = localWishlistCount; // Update the count display
    }

    // Update wishlist on the server
    updateWishlist(productId, !isFavorited)
        .then(response => {
            // Remove spinner and re-enable pointer events
            spinner.remove();
            element.style.pointerEvents = 'auto'; 

            // Toggle favorite class and color
            toggleFavoriteClass(element);
            updateHeartFillColor(element, !isFavorited);

            // Notification for user feedback
            showNotification(!isFavorited ? 'Added to wishlist!' : 'Removed from wishlist!', 'success');

            console.log(response.message); // Log the server response for debugging
        })
        .catch(error => {
            // Handle error gracefully
            spinner.remove();
            element.style.pointerEvents = 'auto'; 

            // Revert local count on error
            localWishlistCount -= change; // Undo the local count change
            if (wishlistCountElement) {
                wishlistCountElement.innerText = localWishlistCount; // Revert the count display
            }

            handleError(error); // Call error handler
        });
}

// Function to update wishlist on the server
function updateWishlist(productId, isFavorited) {
    return axios.post(`/wishlist/add/${productId}`, { favorite: isFavorited })
        .then(response => response.data) // Return data directly
        .catch(error => { throw error; }); // Propagate error
}

function toggleFavoriteClass(element) {
    element.classList.toggle('favorited');
}

function updateHeartFillColor(element, isFavorited) {
    element.setAttribute('fill', isFavorited ? '#FF0000' : 'black');
}

function handleError(error) {
    if (error.response && error.response.status === 401) {
        window.location.href = error.response.data.redirect;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong! Please try again later.',
            confirmButtonText: 'OK'
        });
        console.error('Error updating wishlist:', error);
    }
}

function showNotification(message, type) {
    Swal.fire({
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 1500,
        position: 'top-end',
        toast: true,
    });
}



$(document).ready(function () {
  $('.rating-container').each(function () {
    const stars = $(this).find('.rating-star');

    stars.on('click', function () {
      const rating = $(this).data('value');
      resetStars(stars);
      highlightStars(stars, rating);
    });

    function resetStars(stars) {
      stars.removeClass('active');
    }

    function highlightStars(stars, rating) {
      stars.each(function () {
        if ($(this).data('value') <= rating) {
          $(this).addClass('active');
        }
      });
    }
  });
});

// Rating stars end


