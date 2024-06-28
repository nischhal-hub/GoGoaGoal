document.getElementById("toggle").addEventListener("click", function() {
    console.log("clicked")
    document.getElementById("sidebar").classList.toggle("overlay");
    document.querySelectorAll("#sidebar-space").forEach(element => element.classList.toggle("show"));
});