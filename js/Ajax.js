jQuery(document).ready(function($) {
    var $mainContent = $("#textbox"),
        siteUrl = "http://" + top.location.host.toString(),
        url = ''; 
		
	var filter = ':not([href*=/wp-admin/]):not([href*=/wp-login.php]):not([href$=/feed/]):not([href*=.mp3]):not([href*=.jpg]):not([href*=.png]):not([href*=.gif])';
		
		
	$(document).delegate("a[href^='"+siteUrl+"']" + filter + ", a[href^='/']" + filter, "click", function() {
        location.hash = this.pathname;
		alert(this.pathname);
		return false;
    }); 
	
    $("#searchform").submit(function(e) {
        location.hash = '?s=' + $("#s").val();
		e.preventDefault();
    }); 

    $(window).bind('hashchange', function(){
		url = window.location.hash.substring(1); 
		
        if (!url) {
            return;
        } 

        url = url + " #content"; 
		
		$mainContent.animate({opacity: "0.1"}).html('<p>Please wait...</>').load(url, function() {
            $mainContent.animate({opacity: "1"});
        });
    });

    $(window).trigger('hashchange');
});