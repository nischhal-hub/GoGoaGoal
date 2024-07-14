document.getElementById("toggle").addEventListener("click", function() {
    console.log("clicked")
    document.getElementById("sidebar").classList.toggle("overlay");
    document.querySelectorAll("#sidebar-space").forEach(element => element.classList.toggle("show"));
});

// let modal = document.getElementById("modal");
// let btn = document.getElementById("myBtn");
// let span = document.getElementsByClassName("close")[0];

// // When the user clicks on the button, open the modal if form is valid
// btn.onclick = function (e) {

//     modal.style.display = "block";
//     e.preventDefault();
// }
// span.onclick = function () {
//     modal.style.display = "none";
//     window.location.reload();
// }