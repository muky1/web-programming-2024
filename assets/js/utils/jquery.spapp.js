
// spapp.js
(function($) {
    class SpApp {
        constructor(options) {
            this.config = $.extend({
                defaultView: 'home',
                templateDir: 'pages/',
                pageNotFound: '404.html',
                homeContent: $('#main-content').html()
            }, options);
        }

        routeChange(hash) {
            let self = this;
            if (hash === 'home' || hash === '') {
                $("#main-content").html(self.config.homeContent);
                history.replaceState(null, null, ' '); // Clear the hash
            } else {
                let loadUrl = self.config.templateDir + hash + '.html';
                $("#main-content").load(loadUrl, function(response, status, xhr) {
                    if (status === "error") {
                        $("#main-content").load(self.config.templateDir + self.config.pageNotFound);
                    }
                });
            }
        }

        run() {
            let self = this;
            $(window).on('hashchange', function() {
                let hash = location.hash.slice(1);
                self.routeChange(hash);
            });

            if (!location.hash) {
                // Trigger the default view if there is no hash
                location.hash = self.config.defaultView;
            } else {
                // Trigger the route change function on initial load
                self.routeChange(location.hash.slice(1));
            }
        }
    }

    // Expose SpApp to the global object
    window.SpApp = SpApp;

})(jQuery);
