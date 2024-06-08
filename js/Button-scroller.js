document.addEventListener("DOMContentLoaded", function() {
  const scrollLeftButtons = document.querySelectorAll(".scroll-left-button");
  const scrollRightButtons = document.querySelectorAll(".scroll-right-button");

  scrollLeftButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          const targetId = this.getAttribute("data-target");
          const mediaScroller = document.getElementById(targetId);
          mediaScroller.scrollBy({ left: -300, behavior: "smooth" });
      });
  });

  scrollRightButtons.forEach(function(button) {
      button.addEventListener("click", function() {
          const targetId = this.getAttribute("data-target");
          const mediaScroller = document.getElementById(targetId);
          mediaScroller.scrollBy({ left: 300, behavior: "smooth" });
      });
  });
});
