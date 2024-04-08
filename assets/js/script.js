$(document).ready(function() {
    function loadPage(pageName) {
        $("#main-content").load(`pages/${pageName}.html`, function() {
            history.pushState({ page: pageName }, pageName, `#${pageName}`);
        });
    }

    $("#add-blog").on('click', function(e) {
        e.preventDefault();
        loadPage('blog');
    });

    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        var navbarLinks = document.getElementById('navbar-links');
        navbarLinks.classList.toggle('hidden');
    });

    let mySpApp = new window.SpApp({
        defaultView: 'home',
        templateDir: 'pages/',
        pageNotFound: '404.html'
    });

    // Start the SPA
    mySpApp.run();

    // Bind navigation links to update the hash
    $("nav a:not(#login)").on('click', function(e) {
        e.preventDefault();
        var hash = $(this).attr('href');
        window.location.hash = hash;
    });
});
