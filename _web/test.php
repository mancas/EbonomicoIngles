<?php

include_once ('../bo_cpanel/_procedures/GestionDB.php');

$gestionDB = new GestionDB();

$questions = $gestionDB -> getFormattedTest();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>English Be Prepared: Comprueba tu nivel de Inglés</title>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp-s-001.inc");
        include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/g-analytics.inc");
        ?>

        <link type="text/css" rel="stylesheet" href="../_css/test.css" />
        <link type="text/css" rel="stylesheet" href="../_css/buttons.css" />
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('#send-test').bind('click', function(){
                    $('#loader').fadeIn();
                });
            });
        </script>
        
        <meta name="keywords" content="mide tu nivel de ingles,cursos de ingles a medida,profesores de ingles particulares sevilla,sevilla,ingles,academia de ingles,english be prepared test,test de ingles">
        <meta name="description" content="Aprende Inglés de la mano de los mejores profesionales, de una forma rápida, sencilla y al alcance de tu mano.">

    </head>

    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp002.inc");
        ?>

        <div class="media-container">

            <h2>Comprueba tu nivel de <i class="blue">Inglés</i></h2>

            <span class="content-right">
                <form action="../_procedures/correctTest.php" method="post">
                <ul id="test">

                    <?php
                        $counter = 1;
                        foreach ($questions as $question) { 
                    ?>

                    <li>
                        <p>
                            <?php echo $counter . '. ' . $question[0]; ?>
                        </p>
                        <?php 
                            $internalCounter = 1;
                            foreach ($question[1] as $answer) {
                                $id = 'q' . $counter . '-' . $internalCounter;
                                $groupName = 'q' . $counter;
                        ?>
                        <span>
                            <input id="<?php echo $id; ?>" name="<?php echo $groupName; ?>" value="<?php echo $answer; ?>" type="radio" />
                            <label for="<?php echo $id; ?>"><?php echo $answer; ?></label> </span>
                        <?php
                        $internalCounter++;
                        }
                        ?>
                        
                    </li>
                    <?php
                    $counter++;
                    }
                    ?>
                    
                    <li>
                        <input id="send-test" class="g-button g-button-submit" type="submit" value="Corregir Test" />
                    </li>
                </ul> </form></span>
            <span class="content-left"> <img alt="Kids" src="../_images/kids2.jpg" />
                 </span>

        </div>
        
        <!-- DIALOG -->
        <div id="loader" class="dialog hide">
            <div>
                <p>Estamos enviando los datos, espera unos segundos para ver tu resultado...</p>
                <img alt="Loading" src="../_images/ajax-loader.gif" />
            </div>
        </div>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/_includes/ebp003.inc");
        ?>
    </body>

</html>