$(document).ready(function() {
  // Get the lightbox
  var lightbox = document.getElementById("mylightbox");



  // Get the <span> element that closes the lightbox
  var span = document.getElementsByClassName("close-lightbox")[0];

  // Check if the span exists before trying to access its properties
  if (!span) {
      console.error('Element with class "close-lightbox" does not exist');
      return;
  }

  // When the user clicks on the buttons, open the lightbox
  function openLightbox() {
      lightbox.style.display = "block";
  }

  // Attach event listener to body and check if clicked element is .fullscreen
  $(document.body).on('click', '.fullscreen', function(event) {
      openLightbox();
      console.log(event.target.closest('.image-container'))
  });

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
  $(document).on('click', '.fullscreen', function () {
      var reference = $('#reference').text().replace('Référence : ', '');
      $('#lightbox-reference').val(reference);
  });
});