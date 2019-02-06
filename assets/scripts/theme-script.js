window.EventList = (function(window, document, $) {

    var app = {
        currentPage: 1
    };

    app.cache = function () {
        app.$mainContainer   = $("#gt-main-content");
        app.$eventsContainer = $(".gt-event-list");
        app.$loadMore        = app.$mainContainer.find(".load-more");
        app.maxNumPages      = parseInt(app.$loadMore.data('max-num-pages'));
        app.$tabs            = $(".gt-event-list-tabs");
    };

    app.init = function() {
        app.cache();
        app.$loadMore.on("click", app.loadMore);
        app.$tabs.on("click", app.openTab);
    };

    app.loadMore = function (e) {
        dp("PageEvents/QueryAll", {
            tidy: true,
            // url: window.location,
            url: "http://localhost/geniem/",
            args: "ARGSSSSS",
            partial: "event-list",
            success: function( data ) {
                app.$eventsContainer.append(data);
                // console.log(data)
            },
            error: function( error ) {
                console.log(error);
            },
        });
        return false;
    };

    app.openTab = function (e) {
        $(".gt-event-list-container").hide();
        $("#gt-event-list-container-"+e.target.id).show();
        $(".gt-event-list-tabs").removeClass('active');
        $("#"+e.target.id).addClass('active');
    };

    app.init();

    return app;

}(window, document, jQuery));
