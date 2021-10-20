// Get the livre
var modal = document.getElementById("myModal");

// Get the button that opens the livre
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the livre
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the livre
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the livre
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the livre, close it
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
} 