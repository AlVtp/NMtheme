document.addEventListener("DOMContentLoaded", function (event) {

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the buttons that open the modal
  var btn1 = document.getElementById("menu-item-96");
  var btn2 = document.getElementById("contact-btn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the buttons, open the modal
  function openModal() {
    modal.style.display = "block";
  }

  btn1?.addEventListener('click', openModal);
  btn2?.addEventListener('click', openModal);

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

  // Add jQuery code here
  $('#contact-btn').click(function () {
    var reference = $('#reference').text().replace('Référence : ', '');
    $('#modal-reference').val(reference);
  });

});