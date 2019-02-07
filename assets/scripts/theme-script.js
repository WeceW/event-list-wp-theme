window.EventList = (function(window, document, $) {

    var app = {
        allEventsCurrentPage: 1,
        upcomingEventsCurrentPage: 1
    };

    app.cache = function () {
        app.$mainContainer              = $("#gt-main-content");
        app.$loadMoreAllEvents          = app.$mainContainer.find("#load-more-all-events");
        app.$loadMoreUpcomingEvents     = app.$mainContainer.find("#load-more-upcoming-events");
        app.allEventsMaxNumPages        = parseInt(app.$loadMoreAllEvents.data('max-num-pages'));
        app.upcomingEventsMaxNumPages   = parseInt(app.$loadMoreUpcomingEvents.data('max-num-pages'));
        app.$tabs                       = $(".gt-event-list-tabs");
    };

    app.init = function() {
        app.cache();
        app.$loadMoreAllEvents.on("click", app.loadMoreAllEvents);
        app.$loadMoreUpcomingEvents.on("click", app.loadMoreUpcomingEvents);
        app.$tabs.on("click", app.openTab);
    };

    app.loadMoreAllEvents = function (e) {
        dp("PageEvents/QueryAll", {
            args: ++app.allEventsCurrentPage,
            tidy: true,
            url: document.location.origin + "/" + document.URL.split('/')[3] + "/",
            partial: "event-list",
            success: function( data ) {
                $('#'+e.target.id).prev('.gt-event-list').append(data);
                if ( app.allEventsCurrentPage === app.allEventsMaxNumPages ) {
                    app.$loadMoreAllEvents.hide();
                }
            },
            error: function( error ) {
                console.log(error);
            },
        });
        return false;
    };

    app.loadMoreUpcomingEvents = function (e) {
        dp("PageEvents/QueryUpcoming", {
            args: ++app.upcomingEventsCurrentPage,
            tidy: true,
            url: document.location.origin + "/" + document.URL.split('/')[3] + "/",
            partial: "event-list",
            success: function( data ) {
                $('#'+e.target.id).prev('.gt-event-list').append(data);
                if ( app.upcomingEventsCurrentPage === app.upcomingEventsMaxNumPages ) {
                    app.$loadMoreUpcomingEvents.hide();
                }
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
