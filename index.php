<?php
include_once ('bo_cpanel/_procedures/GestionDB.php');

$gestionDB = new GestionDB();

$hasBanners = $gestionDB -> hasBanners();

if ($hasBanners == 0) {
	$style = 'simpleStyle';
	$columns = false;
} else {
	$style = 'bannerStyle';
	$columns = true;
	$banners = $gestionDB -> getBannersInicio();
}

$textos = $gestionDB -> getTextos();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>English Be Prepared</title>
		
		<link rel="icon" href="_images/favicon_english_be_prepared.png" type="image/png">

		<link type="text/css" rel="stylesheet" href="_css/style.css" />
		<link type='text/css' href='_css/fonts.css' rel='stylesheet' />
		<link type='text/css' href='_css/slideshow.css' rel='stylesheet' />
		
		<link type='text/css' href='_css/<?php echo $style; ?>.css' rel='stylesheet' />

		<script type="text/javascript" src="_js/util.js"></script>
		<script type="text/javascript" src="_js/slideshow.js"></script>
		<script type="text/javascript" src="_js/jQuery-min.js"></script>

		<script type="text/javascript">
			$(function() {
				setInterval("slideSwitch()", 5000);
			});
		</script>
		
		<?php
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/g-analytics.inc");
		?>
				
		<meta name="keywords" content="academia ingles sevilla,academia ingles,aprende ingles,cursos de ingles,ingles en sevilla,profesores de ingles,porfesores particulares">
		<meta name="description" content="Aprende Inglés de la mano de los mejores profesionales, de una forma rápida, sencilla y al alcance de tu mano.">

	</head>

	<body>

		<?php
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp001.inc");
		?>

		<div class="media-container">
		<?php if ($columns) { ?>
			<div id="banner-left">
                <ul class="banner">
                   	<?php foreach ($banners['0'] as $banner) { 
                    		$name = ucfirst($banner['name']);
							$route =  $banner['path'];
							$link = $banner['link'];
                    	?>
                    <li id="b1">
                        <a title="<?php echo $name; ?>" <?php if (!empty($link)) { ?>href="<?php echo $link; ?>" <?php } ?> target="<?php if (!empty($link)) { echo $name; } ?>"><img alt="<?php echo $name ?>" src="<?php echo $route ?>" /></a>
                    </li>
                    <?php } ?>
                    
                    <?php foreach ($banners['2'] as $banner) { 
                    		$name = ucfirst($banner['name']);
							$route = $banner['path'];
							$link = $banner['link'];
                    	?>
                    <li id="b3">
                        <a title="<?php echo $name; ?>" <?php if (!empty($link)) { ?>href="<?php echo $link; ?>" <?php } ?> target="<?php if (!empty($link)) { echo $name; } ?>"><img alt="<?php echo $name ?>" src="<?php echo $route ?>" /></a>
                    </li>
                    <?php } ?>
                </ul>
			</div>
		<?php } ?>
			<!-- COURSES --->
			<div id="index-content">

				<div id="_kids" class="info-box" onmouseover="showText('_kids');" onmouseout="hideText('_kids');" onclick="changeLocation('_web/ingles-ninos.php');">

					<div class="box-title">
						<span class="title">Inglés para niños</span>
					</div>
					<img id="_kids-photo" title="Inglés para Niños: Más Información" alt="Niños Estudiando Inglés" src="_images/kids.jpg" />

					<span id="_kids-text" class="info-text-hide"><p><?php echo $textos[0]; ?></p></span>
				</div>

				<div class="info-box" onmouseover="showText('_teen');" onmouseout="hideText('_teen');" onclick="changeLocation('_web/ingles-jovenes-y-adultos.php');">

					<div class="box-title">
						<span class="title">Inglés para jóvenes / adultos</span>
					</div>

					<img id="_teen-photo" alt="Clase de Inglés de Jóvenes y Adultos" title="Inglés para Jóvenes y Adultos: Más Información" src="_images/teenagers.jpg" />

					<span id="_teen-text" class="info-text-hide"><p><?php echo $textos[1]; ?></p></span>

				</div>

				<div class="info-box" onmouseover="showText('_business');" onmouseout="hideText('_business');" onclick="changeLocation('_web/ingles-empresas.php');">

					<div class="box-title">
						<span class="title">Inglés para empresas</span>
					</div>

					<img id="_business-photo" alt="Inglés y Empresa" title="Inglés para Empresas: Más Información" src="_images/business.jpg" />

					<span id="_business-text" class="info-text-hide"><p><?php echo $textos[2]; ?></p></span>

				</div>

				<div class="info-box" onmouseover="showText('_internet');" onmouseout="hideText('_internet');" onclick="changeLocation('_web/ingles-internet.php');">

					<div class="box-title">
						<span class="title">Inglés por Internet</span>
					</div>

					<img id="_internet-photo" alt="Inglés en Internet" title="Inglés por Internet: Más Información" src="_images/business2.jpg" />

					<span id="_internet-text" class="info-text-hide"><p><?php echo $textos[3]; ?></p></span>

				</div>

				<!-- Contact phone number -->
                <div id="social-contact">
    				<div class="info-contact">
    					<span> Información en el <b>666 647 852</b> </span>
    				</div>
    				
    				<a class="fb" title="English Be Prepared en Facebook" href="http://www.facebook.com/englishbe.prepared" target="fb"><img alt="Facebook" src="_images/boton_facebook.gif" /> Síguenos en facebook</a>
				</div>
			</div>

		<?php if ($columns) { ?>
			<div id="banner-right">
                <ul class="banner">
                   <?php foreach ($banners['1'] as $banner) { 
                    		$name = ucfirst($banner['name']);
							$route =  $banner['path'];
							$link = $banner['link'];
                   	?>
                   	<li id="b2">
                    	<a title="<?php echo $name; ?>" <?php if (!empty($link)) { ?>href="<?php echo $link; ?>" <?php } ?> target="<?php if (!empty($link)) { echo $name; } ?>"><img alt="<?php echo $name ?>" src="<?php echo $route ?>" /></a>
                    </li>
                    <?php } ?>
                    
                    <?php foreach ($banners['3'] as $banner) { 
                    		$name = ucfirst($banner['name']);
							$route =  $banner['path'];
							$link = $banner['link'];
                    ?>
                    <li id="b4">
                    	<a title="<?php echo $name; ?>" <?php if (!empty($link)) { ?>href="<?php echo $link; ?>" <?php } ?> target="<?php if (!empty($link)) { echo $name; } ?>"><img alt="<?php echo $name ?>" src="<?php echo $route ?>" /></a>
                    </li>
                   	<?php } ?>
                </ul>
			</div>
		<?php } ?>
		
		</div>

		<?php
		include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp003.inc");
		?>

	</body>

</html>

