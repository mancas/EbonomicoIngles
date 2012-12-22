/**
 * @author Manuel Casas
 */


function showText(id){
	
	$element = $('#'+id+'-text');
	$photo = $('#'+id+'-photo');
	
	$photo.css({opacity: 0.3});
	$element.css({display: 'block'});
	
}

function hideText(id){
	$element = $('#'+id+'-text');
	$photo = $('#'+id+'-photo');
	
	$photo.css({opacity: 1});
	$element.hide();
}

function changeLocation(url) {

	window.location.href = url;

	return true;

}