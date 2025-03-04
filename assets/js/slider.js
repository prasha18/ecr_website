 // numbers slider
$(document).ready(function() {
  var time = 6000;
  var timeReset = time;
  var isScrolling = false;

  setInterval(function() {
    if (!isScrolling) {
      time = time - 1000;
      var $activeItem = $(".lets-slider > .item.active");
      var $nextItem = $activeItem.next();
      var $prevItem = $activeItem.prev();

      function nextSlide() {
        $activeItem.removeClass("active");
        $nextItem.addClass("active");
        setNav();
        time = timeReset;
      }

      function prevSlide() {
        $activeItem.removeClass("active");
        $prevItem.addClass("active");
        setNav();
        time = timeReset;
      }

      if ($(".lets-slider > .item").last().hasClass("active")) {
        $nextItem = $(".lets-slider > .item").first();
      }
      if (time <= 0) {
        nextSlide();
      }
    }
  }, 1000);

  // Build Slider Navigation
  $(".lets-slider > .item").each(function(i) {
    $(this).attr("data-id", i);
    $(".slider-nav").append('<a href="#" data-id="' + i + '"></a>');
  });

  $('.slider-nav > a[data-id="' + $('.lets-slider > .item.active').attr("data-id") + '"]').addClass('active');

  function setNav() {
    $('.slider-nav > a').removeClass('active');
    $('.slider-nav > a[data-id="' + $('.lets-slider > .item.active').attr("data-id") + '"]').addClass('active');
  }

  $(".slider-nav > a").on("click", function(e) {
    e.preventDefault();
    $(".slider-nav > a").removeClass("active");
    $(".lets-slider .item.active").removeClass("active");
    $('.slider-nav > a[data-id="' + $(this).attr("data-id") + '"]').addClass('active')
    $('.lets-slider .item[data-id="' + $(this).attr("data-id") + '"]').addClass("active");
    time = timeReset;
  });

  $(".slider-control").on("click", function() {
    var $activeItem = $(".slider > .item.active");
    var $nextItem = $activeItem.next();
    var $prevItem = $activeItem.prev();
    if ($(this).hasClass('prev')) {
      if ($('.lets-slider > .item').first().hasClass('active')) {
        $(".lets-slider > .item").first().removeClass("active");
        $(".slider-nav > a").first().removeClass("active");
        $('.lets-slider > .item').last().addClass('active');
        $('.slider-nav > a').last().addClass('active');
      } else {
        $activeItem.removeClass('active');
        $('.slider-nav > a').removeClass('active');
        $prevItem.addClass('active');
        $('.slider-nav a[data-id="' + $prevItem.attr("data-id") + '"]').addClass("active");
      }
    }
    if ($(this).hasClass('next')) {
      if ($('.lets-slider > .item').last().hasClass('active')) {
        $(".lets-slider > .item").last().removeClass("active");
        $(".slider-nav > a").last().removeClass("active");
        $('.lets-slider > .item').first().addClass('active');
        $('.slider-nav > a').first().addClass('active');
      } else {
        $activeItem.removeClass('active');
        $('.slider-nav > a').removeClass('active');
        $nextItem.addClass('active');
        $('.slider-nav a[data-id="' + $nextItem.attr("data-id") + '"]').addClass("active");
      }
    }
    time = timeReset;
  });

  // Scroll event handling
  $(window).on('scroll', function() {
    if ($(this).scrollTop() > 0) {
      isScrolling = true;
    } else {
      isScrolling = false;
    }
  });

});

 

// content-time slider
// ==========================================================================================
$(document).ready(function() {
  var time; // Define the initial time based on screen size

  // Function to update time based on screen size
  function updateTime() {
    var screenWidth = $(window).width();

    // Adjust timing based on screen width
    if (screenWidth <= 1200) {
      time = 5500; // For screens <= 1200px wide
    } else if (screenWidth <= 1400) {
      time = 5000; // For screens between 1200px and 1400px wide
    } else if (screenWidth <= 1550) {
      time = 6000; // For screens between 1350px and 1550px wide
    } else {
      time = 6000; // For screens wider than 1550px
    }
  }

  // Initial call to set the time
  updateTime();

  var timeReset = time;
  var isScrolling = false;

  setInterval(function() {
    if (!isScrolling) {
      time = time - 1500;
      var $activeItem = $(".let-slider > .item.active");
      var $nextItem = $activeItem.next();
      var $prevItem = $activeItem.prev();

      function nextSlide() {
        $activeItem.removeClass("active");
        $nextItem.addClass("active");
        setNav();
        time = timeReset;
      }

      function prevSlide() {
        $activeItem.removeClass("active");
        $prevItem.addClass("active");
        setNav();
        time = timeReset;
      }

      if ($(".let-slider > .item").last().hasClass("active")) {
        $nextItem = $(".let-slider > .item").first();
      }
      if (time <= 0) {
        nextSlide();
      }
    }
  }, 1120);

  // Update the time when the window is resized
  $(window).resize(function() {
    updateTime();
  });

  // Build Slider Navigation
  $(".let-slider > .item").each(function(i) {
    $(this).attr("data-id", i);
    $(".slider-nav").append('<a href="#" data-id="' + i + '"></a>');
  });

  $('.slider-nav > a[data-id="' + $('.let-slider > .item.active').attr("data-id") + '"]').addClass('active');

  function setNav() {
    $('.slider-nav > a').removeClass('active');
    $('.slider-nav > a[data-id="' + $('.let-slider > .item.active').attr("data-id") + '"]').addClass('active');
  }

  $(".slider-nav > a").on("click", function(e) {
    e.preventDefault();
    $(".slider-nav > a").removeClass("active");
    $(".let-slider .item.active").removeClass("active");
    $('.slider-nav > a[data-id="' + $(this).attr("data-id") + '"]').addClass('active')
    $('.let-slider .item[data-id="' + $(this).attr("data-id") + '"]').addClass("active");
    time = timeReset;
  });

  $(".slider-control").on("click", function() {
    var $activeItem = $(".slider > .item.active");
    var $nextItem = $activeItem.next();
    var $prevItem = $activeItem.prev();
    if ($(this).hasClass('prev')) {
      if ($('.let-slider > .item').first().hasClass('active')) {
        $(".let-slider > .item").first().removeClass("active");
        $(".slider-nav > a").first().removeClass("active");
        $('.let-slider > .item').last().addClass('active');
        $('.slider-nav > a').last().addClass('active');
      } else {
        $activeItem.removeClass('active');
        $('.slider-nav > a').removeClass('active');
        $prevItem.addClass('active');
        $('.slider-nav a[data-id="' + $prevItem.attr("data-id") + '"]').addClass("active");
      }
    }
    if ($(this).hasClass('next')) {
      if ($('.let-slider > .item').last().hasClass('active')) {
        $(".let-slider > .item").last().removeClass("active");
        $(".slider-nav > a").last().removeClass("active");
        $('.let-slider > .item').first().addClass('active');
        $('.slider-nav > a').first().addClass('active');
      } else {
        $activeItem.removeClass('active');
        $('.slider-nav > a').removeClass('active');
        $nextItem.addClass('active');
        $('.slider-nav a[data-id="' + $nextItem.attr("data-id") + '"]').addClass("active");
      }
    }
    time = timeReset;
  });

  // Scroll event handling
  $(window).on('scroll', function() {
    if ($(this).scrollTop() > 0) {
      isScrolling = true;
    } else {
      isScrolling = false;
    }
  });
});
