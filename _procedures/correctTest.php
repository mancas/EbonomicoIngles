<?php
include_once ('../bo_cpanel/_procedures/GestionDB.php');
include_once 'Test.php';

session_start();

$gestionDB = new GestionDB();

$correctAnswers = $gestionDB -> getTestAnswers();

$userAnswers = array();

for ($i = 1; $i <= count($correctAnswers); $i++) {
    $aux = $_REQUEST['q' . $i];
    if (strpos($aux, '\\') === false) {
        $userAnswers[] = $aux;
    } else {
        $userAnswers[] = str_replace('\\', '', $aux);
    }
}

$test = Test::getInstance();

$test -> setResults($userAnswers, $correctAnswers);
$test -> setRespuestas($userAnswers);

$rank = $gestionDB -> getRankPosition($test -> getResults());
$test -> setRank($rank);

$gestionDB -> createRankingMark($test -> getResults(), $test -> getAciertos(), $test -> getErrores(), $test -> getNoContestadas());

$_SESSION['userTest'] = $test;
header('Location:../_web/resumen-test.php');
?>