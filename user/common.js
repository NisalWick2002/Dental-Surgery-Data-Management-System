includeHTML();

var currentPage = window.location.href.split("/").pop();

var links = document.querySelectorAll(".nav-link");

links.forEach(function(link) {
    if (link.getAttribute("href") === currentPage) {
        link.classList.add("myactive");
    } else {
        link.classList.remove("myactive");
    }
});