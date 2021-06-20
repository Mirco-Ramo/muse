var modal = document.getElementById("myModal");

var span = document.getElementById("closeModal");

modal.style.display = "block";

//chiusura sulla x
span.onclick = function() {
  modal.style.display = "none";
}

//chiusura cliccando fuori dal popup
window.onclick = function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
}