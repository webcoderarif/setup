// sticy header start
function openNav() {
    document.getElementById("menu_layer").style.width = "100%";
}

function closeNav() {
  document.getElementById("menu_layer").style.width = "0%";
  $(".mobile_menu").unbind("click");
}

window.onscroll = function() {myFunction()};

var header = document.getElementById("navbar");
var sticky = 180;

function myFunction() {
  if (window.pageYOffset > sticky) {
    // header.classList.add("sticky");
    header.classList.add("sticky_block");
  } else {
    // header.classList.remove("sticky");
    header.classList.remove("sticky_block");
  }
}
// sticy header end

$(document).ready(function(){

  // top to start
    $topOffset=350;
    $('.top_to i').click(function(){
        $('html,body').animate({
            scrollTop: 0
        },800);
    });
    $(window).scroll(function(){
        $scrolling=$(this).scrollTop();
        var width = $(window).width();
        if($scrolling > $topOffset){
            $('.top_to i').fadeIn(500);
        }
         else{
             $('.top_to i').fadeOut(500);
         }
    });

  $('.header_slider').owlCarousel({
      margin:10,
      nav:true,
      dots: false,
      loop:true,
      autoplay:true,
      autoplayTimeout:3500,
      responsiveClass:true,
      smartSpeed:2000,
      animateOut: 'fadeOut',
      responsive:{
          0:{
              items:1,
              nav:false
          },
          400:{
              items:1,
              nav:false
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  })
});
