$(function() {
  // Launch lightbox: http://cornel.bopp-art.com/lightcase
  $("a[data-rel^=lightcase]").lightcase({
    transitionOpen: "fade",
    transition: "scrollHorizontal",
    showCaption: false,
    shrinkFactor: 0.9
  });
  
  // Fade images in on load
 [].forEach.call(document.querySelectorAll("img[data-src]"), (img) => {
    img.setAttribute("src", img.getAttribute("data-src"));
    img.onload = () => {
      img.removeAttribute("data-src");
    };
  });
});

// TODO: Add lazyloading with intersection observer
// https://medium.com/@aganglada/intersection-observer-in-action-efc118062366