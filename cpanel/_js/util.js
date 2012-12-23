function toggleActiveBanner($id) {

    $input = $('#banner_' + $id).is(":checked");
    $select = $('#_position_' + $id);
    if ($input) {
        $value = 1;
        $select.attr('disabled', false);
    } else {
        $select.attr('disabled', true);
        $value = 0;
    }

    writeInfo()

    $.post('../_procedures/toggleBanners.php', {
        id : $id,
        value : $value
    }, function(data) {

        if (data.indexOf('Aviso') != -1) {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-error action-error action');
        } else {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-info action-info action');
        }
        $('#message').html(data);
    });

    setTimeout(function() {
        location.reload();
    }, 3000);

}

function updatePosition($id) {

    $value = $('#_position_' + $id).val();

    writeInfo()

    $.post('../_procedures/update.php', {
        id : $id,
        action : 'position',
        value : $value
    }, function(data) {

        if (data.indexOf('Aviso') != -1) {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-error action-error action');
        } else {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-info action-info action');
        }
        $('#message').html(data);
    });

    setTimeout(function() {
        closeAlert();
    }, 3000);
}

function deleteItem($item, $id) {

    writeInfo()

    $.post('../_procedures/remove.php', {
        item : $item,
        id : $id
    }, function(data) {

        if (data.indexOf('Aviso') != -1) {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-error action-error action');
        } else {
            $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
            $('#message-alert').addClass('alert alert-info action-info action');
        }
        $('#message').html(data);
    });

    setTimeout(function() {
        location.reload();
    }, 2000);

}

//GENERAL

function closeAlert() {
    $('#message-alert').hide();
    $('#message').html("");
    $('#message-alert').removeClass("alert alert-error action-error action alert-info action-info");
}

function writeInfo() {
    $('#message-alert').addClass('alert alert-info action-info action');
    $('#message-alert').fadeIn();
    $('#message').html("<strong>Info:</strong> Su petición se esta procesando. Esta acción puede tardar unos segundos.");
}

function alertInfo() {

    $("a.info").bind('click', function(event) {
        event.preventDefault();
    });

    $("a.info").bind('mouseenter mouseleave', function(event) {
        $(this).find('>span').toggleClass('hide');
    });
}

function countChars() {
	$item = $('#charCounter');
	$value = $('#item_texto').val();
	$value = $value.length;
	$maxChars = 130;
	
	if ($value < $maxChars) {
		$item.html($maxChars - $value);
		$item.removeClass('text-error');
		$('input[type="submit"]').removeAttr('disabled');
		$('input[type="submit"]').removeClass('btn-danger');
	} else {
		$item.html($maxChars - $value);
		$item.addClass('text-error');
		$('input[type="submit"]').attr('disabled', 'disabled');
		$('input[type="submit"]').addClass('btn-danger');
	}
	
}
