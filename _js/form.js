/**
 * @author Manuel Casas
 */

var expRegEmail = /^[\w+\.]+@([\w+]+\.)+[\w+]{2,4}$/;

function checkName(idName){
	$elementValue = $('#'+idName).val();
	$idError = idName.substring(1);
	$elementError = $('#e-'+$idError);
	$control = true;
	
	if ($elementValue == "") {
		$elementError.html('Introduzca su nombre, por favor');
		$control = false;
	}else{
		$elementError.html('');
		$control = true;
	}
	
	return $control;
}


function checkMail(idMail){
	
	$elementValue = $('#'+idMail).val();
	$idError = idMail.substring(1);
	$elementError = $('#e-'+$idError);
	$control = true;
	
	if (!expRegEmail.test($elementValue)) {
		$elementError.html('Introduzca una dirección de correo válida');
		$control = false;
	}else{
		$elementError.html('');
		$control = true;
	}
	
	return $control;
}

function checkMessage(idMessage){
	
	$elementValue = $('#'+idMessage).val();
	$idError = idMessage.substring(1);
	$elementError = $('#e-'+$idError);
	$control = true;
	
	if ($elementValue == "") {
		$elementError.html('Escriba un mensaje');
		$control = false;
	}else{
		$elementError.html('');
		$control = true;
	}
	
	return $control;
}

function checkContacta(idMail, idMessage, idName){
	
	$name = checkName(idName);
	$mail = checkMail(idMail);
	$message = checkMessage(idMessage);
	
	return $mail && $message && $name;
	
}
