
jQuery(document).ready(function() {
    jQuery(".gt-event-list-tabs").click(function(event) {
        openTab(event.target.id);
    });
});

function openTab(evtId) {
    jQuery(".gt-event-list-container").hide();
    jQuery("#gt-event-list-container-"+evtId).show();

    jQuery(".gt-event-list-tabs").removeClass('active');
    jQuery("#"+evtId).addClass('active');
}

