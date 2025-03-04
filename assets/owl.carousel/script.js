$(function() {
  // Owl Carousel
  var owl = $(".owl-carousel");
  owl.owlCarousel({
    items: 4,
    margin: 0,
    loop: true,
    nav: true,
    responsive: {
      0: {
        items: 1 // 1 item on mobile view
      },
      768: {
        items: 4 // 3 items on larger screens
      }
    }
});
});