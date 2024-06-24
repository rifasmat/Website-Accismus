// Target Link Bos Discord
document.getElementById("discord-icon").addEventListener("click", function() {
    var url = this.getAttribute("data-url");
    window.open(url, "_blank");
});

// Target Link Bos Instagram
document.getElementById("instagram-icon").addEventListener("click", function() {
    var url = this.getAttribute("data-url");
    window.open(url, "_blank");
});

// Target Link Box Whatsapp 
document.getElementById("whatsapp-icon").addEventListener("click", function() {
    var url = this.getAttribute("data-url");
    window.open(url, "_blank");
});

// Gallery
  document.addEventListener("DOMContentLoaded", function() {
    const lightbox = GLightbox({
      selector: '.glightbox'
    });
  });

  