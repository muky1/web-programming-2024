$(document).ready(function () {
  // Initialize the SPA framework with configuration
  var app = $.spapp({
    defaultView: "home", // Set the default view
    pageNotFound: "error_404", // Set the page not found view
  });

  // Start the SPA
  app.run();

  // Mobile menu toggle
  $("#mobile-menu-toggle").click(function () {
    $("#navbar-links").toggleClass("hidden");
  });
});
