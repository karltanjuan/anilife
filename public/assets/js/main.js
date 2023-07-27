// Intro Animation
// const tl = gsap.timeline({ defaults: { ease: "power1.out" } });

// tl.to(".text", { y: "0%", duration: 1, stagger: 0.25 });
// tl.to(".slider", { y: "-100%", duration: 1.5, delay: 0.5 });
// tl.to(".intro", { y: "-100%", duration: 1 }, "-=1");
// tl.fromTo("header", { opacity: 0 }, { opacity: 1, duration: 1 });
// tl.fromTo("#home", { y: -7, opacity: 0 }, { y: 7, opacity: 1, duration: 1 }, "-=1");


// Show the Back to Top button when scrolled down 300px from the top of the document
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
    document.getElementById("btnTop").setAttribute("style","opacity: 1; visibility: visible;");
  } else {
    document.getElementById("btnTop").setAttribute("style","opacity: 0; visibility: hidden;");
  }
}

// Scroll to the top when the user cicks the button
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

// Force scroll to the top of the page on page reload
if (history.scrollRestoration) {
  history.scrollRestoration = 'manual';
} else {
  window.onbeforeunload = function () {
      window.scrollTo(0, 0);
  }
}


// Removing anchor link id tags and # on URL
// Original JavaScript code by Chirp Internet: chirpinternet.eu
window.addEventListener("DOMContentLoaded", function(e) {
  var links = document.getElementsByClassName("menuBtn");
  for(var i=0; i < links.length; i++) {
    if(!links[i].hash) continue;
    if(links[i].origin + links[i].pathname != self.location.href) continue;
    (function(anchorPoint) {
      links[i].addEventListener("click", function(e) {
        anchorPoint.scrollIntoView(true);
        e.preventDefault();
      }, false);
    })(document.getElementById(links[i].hash.replace(/#/, "")));
  }
}, false);
