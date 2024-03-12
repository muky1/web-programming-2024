$(document).ready(function() {
    $("#menu-toggle").click(function() {
        $("#menu").toggleClass("hidden");
    })
})

$(document).ready(function() {
    $("nav a#about").on('click', function(e) {
        e.preventDefault();
        $("#main-content").load("pages/about.html");
    })
})

$(document).ready(function() {
    $("nav a#categories").on('click', function(e) {
        e.preventDefault();
        $("#main-content").load("pages/categories.html");
    })
})

$(document).ready(function() {
    $("nav a#home").on('click', function(e) {
        e.preventDefault();
        window.location.href = 'index.html';
    })
})

$(document).ready(function() {
    $("nav a#contact").on('click', function(e) {
        e.preventDefault();
        $("#main-content").load("pages/contact.html");
    })
})

