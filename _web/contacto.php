<?php
session_start();

$data = $_SESSION['_contacta'];
$warnings = $_SERVER['_warning'];

if(!isset($data)){
	$data['_mail'] = "";
	$data['_message'] = "";
	$data['_name'] = "";
	$_SESSION['_contacta'] = $data;
}

if(!isset($warnings)){
	$warnings['_mail'] = "";
	$warnings['_message'] = "";
	$warnings['_name'] = "";
	$_SESSION['_warning'] = $warnings;
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
		<link type='text/css' href='../_css/buttons.css' rel='stylesheet' />
		<?php
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp-s-001.inc");
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/g-analytics.inc");
		?>
		
		<script type="text/javascript" src="../_js/form.js"></script>

	</head>

	<body>
		<div class="body-content">

			<?php
			include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp002.inc");
			?>

			<div class="media-container">
				
				<h2>Contacta con <span class="blue">Nosotros</span></h2>
				
				<span class="content-right">
					<p>
						<span class="bblue">Dirección:</span> Calle López de Gomara, 18. Sevilla
					</p>
					
					<p>
						<span class="bblue">Teléfono de Contacto:</span> 666 647 852
					</p>
					
					<p>
						<span class="bblue">Correo Electrónico:</span> info@englishbeprepared.com 
					</p>
					
					<p>
						Si necesitas que te resolvamos alguna duda o necesitas más información, no dudes en escribirnos a través del siguiente formulario:
					</p>
					
					<form id="contact" method="post" onsubmit="return checkContacta('_mail', '_message', '_name')" action="../_procedures/checkContacta.php">
						
						<p>
							<label for="_name">Nombre:</label>
							<span><input type="text" id="_name" name="_name" onchange="checkName('_name');" value="<?php echo $data['_name']; ?>" /></span>
							<span id="e-name" class="warning"><?php echo $warnings['_name']; ?></span>
						</p>
						
						<p>
							<label for="_mail">Email:</label>
							<span><input type="text" id="_mail" name="_mail" onchange="checkMail('_mail');" value="<?php echo $data['_mail']; ?>" /></span>
							<span id="e-mail" class="warning"><?php echo $warnings['_mail']; ?></span>
						</p>
						
						<p>
							<label for="_message">Mensaje:</label>
							<span><textarea id="_message" name="_message" rows="10" onchange="checkMessage('_message');"><?php echo $data['_message']; ?></textarea></span>
							<span id="e-message" class="warning"><?php echo $warnings['_message']; ?></span>
						</p>
						
						<p>
							<span class="button"><input type="submit" id="sendButton" class="g-button g-button-submit" value="Enviar" /></span>
						</p>

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