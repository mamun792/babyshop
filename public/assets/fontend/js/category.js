
$(document).ready(function(){
    $(window).scroll(function(){
     if ($(this).scrollTop() > 50) {
       $("#scroll-top-btn").fadeIn();
     }
     else {
      $("#scroll-top-btn").fadeOut();
     }
    });
  
  $("#scroll-top-btn").click(function(){
    $('html ,body').animate({scrollTop : 0},100);
  });
  
  });
  

// add to favourite heart start
  
function toggleFavorite(element) {
  $(element).toggleClass('active');
}

// add to favourite heart end

// Rating stars start

$(document).ready(function() {
$('.rating-container').each(function() {
    const stars = $(this).find('.rating-star');

    stars.on('click', function() {
        const rating = $(this).data('value');
        resetStars(stars);
        highlightStars(stars, rating);
    });

    function resetStars(stars) {
        stars.removeClass('active');
    }

    function highlightStars(stars, rating) {
        stars.each(function() {
            if ($(this).data('value') <= rating) {
                $(this).addClass('active');
            }
        });
    }
});
});

// Rating stars end

function toggleDropdown(btn) {
  var dropdownContent = btn.nextElementSibling;
  dropdownContent.classList.toggle("show");

  var plusIcon = btn.querySelector(".fa-angle-down");
    plusIcon.classList.toggle("rotate");
   

  // Close other dropdowns
  var allDropdowns = document.querySelectorAll('.dropdown-content');
  allDropdowns.forEach(function(dropdown) {
      if (dropdown !== dropdownContent) {
          dropdown.classList.remove("show");
      }
  });
}

// JavaSc

// Update selection count
function updateSelection(checkbox) {
  var dropdownContent = checkbox.closest('.dropdown-content');
  var selectedCount = dropdownContent.querySelectorAll('input[type="checkbox"]:checked').length;
  dropdownContent.querySelector('.selected-count').textContent = selectedCount + " Selected";
}

// Clear all selected checkboxes
function clearAllSelections(clearBtn) {
  var dropdownContent = clearBtn.closest('.dropdown-content');
  var checkboxes = dropdownContent.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(function(checkbox) {
      checkbox.checked = false;
  });
  dropdownContent.querySelector('.selected-count').textContent = "0 Selected";
}

// Close dropdowns when clicking outside
window.onclick = function(event) {
  if (!event.target.closest('.dropdown') && !event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }

      // Reset all angle icons back to down arrow
      var angles = document.querySelectorAll('.angle');
      angles.forEach(function(angle) {
          angle.classList.remove('up');
          angle.innerHTML = "&#9660;";
      });
  }
}
 