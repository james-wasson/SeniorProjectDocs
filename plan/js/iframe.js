$().ready(function() {
    var $iframe = $("#planIframe");
    // keeps content from overrunning the sidebar
    var checkWindow = function(){
        if ($(window).width() > 1000)
            $iframe.css({ 'padding-left': $iframe.width()/2*.2 })
        else
            $iframe.css({ 'padding-left': $iframe.width()/2*.05 })
        console.log($iframe.css('padding-left'));
    }
    $(window).resize(checkWindow);
    checkWindow();
});