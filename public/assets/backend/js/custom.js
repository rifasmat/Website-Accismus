// box icon sosmed di home dapat di klik dan diarahkan ke link
// Target Link Bos Discord
document.getElementById("discord-icon").addEventListener("click", function() {
    window.open("https://discord.gg/3hN5BrFbdj", "_blank");
  });

// Target Link Bos Instagram
  document.getElementById("instagram-icon").addEventListener("click", function() {
    window.open("https://www.instagram.com/accismuscom/", "_blank");
  });

// Target Link Box Whatsapp 
document.getElementById("whatsapp-icon").addEventListener("click", function() {
    window.open("https://wa.me/6281933124668", "_blank");
  });

  
// menampilkan foto about dan benefit pada saat pengguna mau menggantinya
function previewImage() {
  const file = document.getElementById('foto').files[0];
  const preview = document.getElementById('fotoPreview');

  if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
          preview.src = e.target.result;
      }

      reader.readAsDataURL(file);
  }
}

// menampilkan foto create pengguna
function previewImage() {
  const file = document.getElementById("uploadFoto").files[0];
  const preview = document.getElementById("previewFoto");
  
  const reader = new FileReader();
  
  reader.addEventListener("load", function () {
      preview.src = reader.result;
      preview.style.display = "block";
  }, false);
  
  if (file) {
      reader.readAsDataURL(file);
  }
}

// menampilkan foto pengguna ketika ei edit
function previewImage() {
  const file = document.getElementById('foto').files[0];
  const preview = document.getElementById('fotoPreview');

  if (file) {
      const reader = new FileReader();

      reader.onload = function(e) {
          preview.src = e.target.result;
      }

      reader.readAsDataURL(file);
  }
}
