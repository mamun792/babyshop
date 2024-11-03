 
window.addEventListener("scroll", function () {
  var nav = document.querySelector("header");
  nav.classList.toggle("fixed-top", window.scrollY > 150);
});


// top button start

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

// top button end
 
 