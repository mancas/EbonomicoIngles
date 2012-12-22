<?php 

session_start();

$data = $_SESSION['_contacta'];

$_SESSION['_warning'] = null;
$_SESSION['_contacta'] = null;

session_destroy();

if (!isset($data)) {
	header("Location:../index.php");
} else {

	require_once ("../_phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	
	$address = $data['_mail'];
	$name = $data['_name'];
	
	$mail -> AddReplyTo($address,$name);
	$mail->SetFrom($address,$name);

	$mail->AddAddress('manolo_91@live.com', 'Manuel Casas');
	$mail -> Subject = "Contacto";
	//$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

	//$aux = $data['uSex'] . " " . $name . "\n\n" . $data['uMessage'] . "\n\n" . "Teléfono de contacto: " . $data['uPhone'];
	$body = $data['_message'];
	$mail -> WordWrap = 50;
	$mail->Body = $body;
	$mail->isHTML(false);

	$ret = $mail -> Send();
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>English Be Prepared: Contacta con Nosotros</title>
		
		<meta name="author" content="Manuel Casas Barrado" />

		<link type='text/css' href='../_css/contacto.css' rel='stylesheet' />
		<?php
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp-s-001.inc");
		?>
		
		<?php if($ret){ ?>
			<META HTTP-EQUIV="Refresh" CONTENT="10; URL=http://www.englishbeprepared.com">
		<?php }else{ ?>
			<META HTTP-EQUIV="Refresh" CONTENT="10; URL=http://www.englishbeprepared.com/_web/contacto.php">
		<?php } ?>
	</head>

	<body>
		<div class="body-content">

			<?php
			include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp002.inc");
			?>

			<div class="media-container">
				
				<h2>Contacta con <span class="blue">Nosotros</span></h2>
				
				<span class="content-right">
					
					<?php if($ret){ ?>
						<p>
							Su mensaje se ha enviado con éxito. Le responderemos tan rápido como nos sea posible.
						</p>
						
						<p>
							Gracias por confiar en nuestros servicios. Si tiene alguna consulta, no dudes en llamarnos, le atenderemos
							gustosamente: 666 647 852
						</p>
						
						<p>
							Si su navegador no le redirige automáticamente, haga click <a class="bblue" title="Volver a la página principal" href="../index.php">aquí</a>.
						</p>
					<?php }else{ ?>
						<h3>Oops! Algo parece ir mal</h3>
						<p>
							Ocurrió un error inesperado durante el envio de su mensaje. Intentelo más tarde. Perdone las molestias.
						</p>
						
						<p>
							Si el error persiste, por favor, ponten en contacto con nosotros a través de este teléfono: 666 647 852 o mándenos un email a la siguiente dirección <a class="bblue" title="Enviar Email" href="mailto:soporte@englishbeprepared.com?subject=Error al envíar formulario de Contacto">soporte@englishbeprepared.com</a>
						</p>
						
						<p>
							Si su navegador no le redirige automáticamente, haga click <a class="bblue" title="Volver a la página de contacto" href="../_web/contacto.php">aquí</a>.
						</p>
					<?php } ?>

					</form>
					
				</span>
				
				<span class="content-left">
					<img alt="Contacta con Nosotros" title="Contacta con nosotros sin ningún tipo de compromiso" src="../_images/contacto.jpg" />
				</span>

			</div>

			<?php
			include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp003.inc");
			?>
		</div>

	</body>

</html>