<?php

class Test {

    protected $aciertos;
    protected $errores;
    protected $noContestadas;
    protected $respuestas;
    protected $rank;
    protected $totalPreguntas;
    private static $instance;

    private function __construct()
    {
        $this -> aciertos = 0;
        $this -> errores = 0;
        $this -> noContestadas = 0;
        $this -> respuestas = array();
        $this -> rank = 0;
        $this -> totalPreguntas = 0;
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __clone()
    {
        trigger_error("Operación Invalida: No puedes clonar una instancia de " . get_class($this) . " class.", E_USER_ERROR);
    }

    public function getAciertos()
    {
        return $this -> aciertos;
    }

    public function getErrores()
    {
        return $this -> errores;
    }

    public function getNoContestadas()
    {
        return $this -> noContestadas;
    }

    public function getRespuestas()
    {
        return $this -> respuestas;
    }

    public function getRank()
    {
        return $this -> rank;
    }

    public function getTotalPreguntas()
    {
        return $this -> totalPreguntas;
    }

    public function setAciertos($aciertos)
    {
        $this -> aciertos = $aciertos;
    }

    public function setErrores($errores)
    {
        $this -> errores = $errores;
    }

    public function setNoContestadas($noContestadas)
    {
        $this -> noContestadas = $noContestadas;
    }

    public function setRespuestas($respuestas)
    {
        $this -> respuestas = $respuestas;
    }

    public function setRank($rank)
    {
        $this -> rank = $rank;
    }

    public function setTotalPreguntas($totalPreguntas)
    {
        $this -> totalPreguntas = $totalPreguntas;
    }

    public function setResults($respuestasUsuario, $respuestasCorrectas)
    {
        $errores = 0;
        $aciertos = 0;
        $noContestadas = 0;

        for ($i = 0; $i < count($respuestasUsuario); $i++) {
            if ($respuestasCorrectas[$i] == $respuestasUsuario[$i]) {
                $aciertos++;
            } else {
                if (!isset($respuestasUsuario[$i])) {
                    $noContestadas++;
                } else {
                    $errores++;
                }
            }
        }

        $this -> setAciertos($aciertos);
        $this -> setErrores($errores);
        $this -> setNoContestadas($noContestadas);
        $this -> setRespuestas($respuestasUsuario);
        $this -> setTotalPreguntas(count($respuestasUsuario));

    }

    public function getResults()
    {
        $aux = (($this -> getAciertos()) - (0.3 * $this -> getErrores())) * 10;
        return round($aux / $this -> getTotalPreguntas(), 2);
    }

    public function getCongratulationsText()
    {
        $points = $this -> getResults();
        if ($points > 5.0) {
            $text = '¡Enhorabuena! Has obtenido ' . $points . ' puntos en el test.';
        } else {
            if ($points < 0.0) {
                $points = 0;
            }
            $text = '¡Oops! Has obtenido ' . $points;
            if ($points == 1) {
                $text .= ' punto en el test. No te preocupes, la proxima vez lo harás mejor.';
            } else {
                $text .= ' puntos en el test. No te preocupes, la proxima vez lo harás mejor.';
            }
        }

        return $text;
    }

}
?>