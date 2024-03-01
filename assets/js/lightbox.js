document.addEventListener("DOMContentLoaded", function (event) {

    // Get the lightbox
    var lightbox = document.getElementById("mylightbox");
  
    // Get the buttons that open the lightbox
    var btnlightbox = document.getElementById("fullscreen");
  
    // Get the <span> element that closes the lightbox
    var span = document.getElementsByClassName("close")[0];
  
    // When the user clicks on the buttons, open the lightbox
    function openLightbox() {
        lightbox.style.display = "block";
    }
  
    btnlightbox.addEventListener('click', openLightbox);
  
    // When the user clicks on <span> (x), close the lightbox
    span.onclick = function () {
        lightbox.style.display = "none";
    }
  
    // When the user clicks anywhere outside of the lightbox, close it
    window.onclick = function (event) {
      if (event.target == lightbox) {
        lightbox.style.display = "none";
      }
    }
  
    // Add jQuery code here
    $('#fullscreen').click(function () {
      var reference = $('#reference').text().replace('Référence : ', '');
      $('#lightbox-reference').val(reference);
    });
  
  });