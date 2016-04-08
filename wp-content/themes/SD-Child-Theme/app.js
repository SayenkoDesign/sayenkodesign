jQuery(function() {
    if (!Date.now) {
        Date.now = function() { return new Date().getTime(); }
    }

    jQuery(".fusion-animated .heading-link").on('mouseenter', function(){
        var that = this;
        var image = jQuery(that).find('img');
        var source = image.attr("src") + '?time=' + Date.now();
        source = source.substring(0, source.indexOf('?'));

        console.log("hovering on " + source);
        if(jQuery(that).hasClass('active')) {
            console.log("already active");
            return;
        }


        var start_time = Date.now();
        console.log("preping " + source + ' at ' + start_time);
        jQuery(that).addClass('active');
        image.attr("src", source);
        jQuery(image).one("load", function() {
            var end_time = Date.now();
            console.log("loaded " + source + ' at ' + end_time);
            console.log('took ' + source + ' ' + (end_time - start_time) + ' to load');
            setTimeout(function() {
                jQuery(that).removeClass('active');
            }, 6000);
        }).each(function() {
            if(this.complete) jQuery(this).load();
        });
    });
});