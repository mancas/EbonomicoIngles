<?php
require_once ('../_procedures/Test.php');
include_once ('../cpanel/_procedures/GestionDB.php');

session_start();

$userTest = $_SESSION['userTest'];

if (!($userTest instanceof Test)) {
    header('Location:test.php');
}

$gestionDB = new GestionDB();

$questions = $gestionDB -> getFormattedTest();
$answers = $gestionDB -> getTestAnswers();
$userAnswers = $userTest -> getRespuestas();
$ranking = $gestionDB -> getRanking() -> rowCount();

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>English Be Prepared: Comprueba tu nivel de Inglés</title>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/_includes/ebp-s-001.inc");
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/_includes/g-analytics.inc");
        ?>

        <link type="text/css" rel="stylesheet" href="../_css/test.css" />
        <link type="text/css" rel="stylesheet" href="../_css/buttons.css" />

        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    </head>

    <body>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/_includes/ebp002.inc");
        ?>

        <div class="media-container">

            <h2>Comprueba tu nivel de <i class="blue">Inglés</i></h2>

            <span class="content-right">
                <p>
                    Aquí tienes tus resultados:
                </p>
                <div id="test-results">
                    <div id="test-resumen">
                        <p class="text-success">
                            <b>Aciertos:</b> <?php echo $userTest -> getAciertos(); ?>

                        </p>
                        <p class="text-error">
                            <b>Errores:</b> <?php echo $userTest -> getErrores(); ?>
                        </p>
                        <p class="blue">
                            <b>No contestadas:</b> <?php echo $userTest -> getNoContestadas(); ?>
                        </p>
                    </div>

                    <div id="test-puntuacion">
                        <h3>Tu Puntuación</h3>

                        <p>
                            <?php echo $userTest -> getCongratulationsText(); ?>
                        </p>
                        <p>
                            Estas en el puesto nº <?php echo $userTest -> getRank(); ?> de los <?php echo $ranking; ?> participantes. 
                            <?php if ($userTest -> getRank() == 1) { ?>¡Genial, eres el número 1!<?php } else { ?>¡Sigue esforzandote para llegar a ser el 1º!<?php } ?>
                        </p>
                    </div>
                </div> 
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
                            <input id="<?php echo $id; ?>" name="<?php echo $groupName; ?>" value="<?php echo $answer; ?>" 
                            <?php if ($userAnswers[$counter-1] == $answer) { ?> 
                                checked="checked" 
                            <?php } ?>
                                type="radio" />
                            <label for="<?php echo $id; ?>"
                                <?php if ($userAnswers[$counter-1] == $answer && $answers[$counter-1] == $answer) { ?>
                                    class = "text-success"
                                <?php } ?>
                                
                                <?php if ($userAnswers[$counter-1] == $answer && $answers[$counter-1] != $answer) { ?>
                                    class = "text-error"
                                <?php } ?>
                                ><?php echo $answer; ?></label> </span>
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
                        <a class="g-button g-button-submit" href="test.php">Repetir Test</a>
                    </li>
                </ul>
                
                </span>
            <span class="content-left"> <img alt="Kids" src="../_images/kids2.jpg" /> </span>

        </div>

        <?php
        include ($_SERVER["DOCUMENT_ROOT"] . "/aptana/ebonomicoingles/_includes/ebp003.inc");
        ?>
    </body>

</html>

<?php 
session_destroy();
?>