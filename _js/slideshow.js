/**
 * @author Manuel Casas
 */


function slideSwitch(){
	
	var $active = $("#slideshow img.active");
	
	
	//If there's no img.active then the new img.active will be the last one
    if ($active.length == 0){
    	$active = $("#slideshow img:last");
    }

    var $next =  $active.next().length ? $active.next() : $('#slideshow img:first');
        
	$active.addClass("last-active");
	$next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 2000, function() {
            $active.removeClass('active last-active');
        });
	
}

