<?php

include ('DataBaseConnection.php');

class GestionDB {

    public function getListadoBanners()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`banner`";
            $banners = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $banners;
    }

    public function hasBanners()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL1 = "SELECT * FROM `englishb_prepared`.`banner` WHERE `active` = 1";
            $result = $connection -> query($SQL1);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result -> rowCount();
    }

    public function getBannersInicio()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        $banners = array();
        try {
            $SQL1 = "SELECT * FROM `englishb_prepared`.`banner` WHERE `posicion` = 1 ORDER BY `banner`.`date`, `banner`.`id` ASC LIMIT 1";
            $banners[] = $connection -> query($SQL1);
            $SQL2 = "SELECT * FROM `englishb_prepared`.`banner` WHERE `posicion` = 2 ORDER BY `banner`.`date`, `banner`.`id` ASC LIMIT 1";
            $banners[] = $connection -> query($SQL2);
            $SQL3 = "SELECT * FROM `englishb_prepared`.`banner` WHERE `posicion` = 3 ORDER BY `banner`.`date`, `banner`.`id` ASC LIMIT 1";
            $banners[] = $connection -> query($SQL3);
            $SQL4 = "SELECT * FROM `englishb_prepared`.`banner` WHERE `posicion` = 4 ORDER BY `banner`.`date`, `banner`.`id` ASC LIMIT 1";
            $banners[] = $connection -> query($SQL4);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $banners;
    }

    public function removeBanner($id)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        $result = array();

        try {
            $SQL = "SELECT `banner`.`path` FROM `englishb_prepared`.`banner` WHERE `banner`.`id` = $id";
            $bannerPath = $connection -> query($SQL);
            $SQL = "DELETE FROM `englishb_prepared`.`banner` WHERE `banner`.`id` = $id";
            $res = $connection -> exec($SQL);

            $result['path'] = $bannerPath;
            $result['OK'] = $res;

        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    public function toggleActiveBanner($id, $value)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "UPDATE `englishb_prepared`.`banner` SET `banner`.`active` = '$value', `banner`.`posicion` = 0 WHERE `banner`.`id` = $id";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    public function updatePosition($id, $value)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "UPDATE `englishb_prepared`.`banner` SET `banner`.`posicion` = '$value' WHERE `banner`.`id` = $id";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    public function createBanner($values)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        $name = $values['name'];
        $link = $values['link'];
        $path = $values['path'];
        $date = $values['date'];

        try {
            $SQL = "INSERT INTO `englishb_prepared`.`banner` (`name`, `path`, `link`, `date`) VALUES ('$name', '$path', '$link', '$date')";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    /**
     * USUARIOS
     */

    public function getUsers()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`users`";
            $users = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $users;
    }

    public function removeUser($id)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "DELETE FROM `englishb_prepared`.`users` WHERE `users`.`id` = $id";
            $result = $connection -> exec($SQL);

        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    public function updateUser($id, $plainPassword)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $passwordCod = md5($plainPassword);
            $SQL = "UPDATE `englishb_prepared`.`users` SET `users`.`password` = '$passwordCod' WHERE `users`.`id` = $id";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    /**
     * TEXTOS INICIO
     */

    public function getTextosInicio()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`textosinicio`";
            $textos = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $textos;
    }

    public function getTextoInicio($id)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`textosinicio` WHERE `id` = $id";
            $texto = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $texto;
    }

    public function getTextos()
    {
        $textos = $this -> getTextosInicio();
        $result = array();
        foreach ($textos as $texto) {
            $result[] = $texto['texto'];
        }

        return $result;
    }

    public function updateTextoInicio($id, $texto)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $passwordCod = md5($plainPassword);
            $SQL = "UPDATE `englishb_prepared`.`textosinicio` SET `textosinicio`.`texto` = '$texto' WHERE `textosinicio`.`id` = $id";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    /**
     * ENGLISH TEST
     */

    public function getTest()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`testnivel`";
            $result = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }

        return $result;
    }

    public function getTestAnswers()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`testnivel`";
            $result = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }

        if ($result) {
            $correctAnswers = array();

            foreach ($result as $question) {
                $correctAnswers[] = $question['answer'];
            }
        }

        return $correctAnswers;
    }

    public function getFormattedTest()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`testnivel`";
            $result = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        if ($result) {
            $formattedQuestions = array();

            foreach ($result as $question) {
                $formattedQuestion = array();
                $aux = str_replace('_', ' <i class="sub"></i> ', $question['question']);
                $formattedQuestion[] = $aux;
                $formattedQuestion[] = explode(';', $question['answerList']);

                $formattedQuestions[] = $formattedQuestion;
            }
        }

        return $formattedQuestions;
    }

    public function getRanking()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`ranking`";
            $result = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

    public function getRankPosition($mark)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "SELECT * FROM `englishb_prepared`.`ranking` WHERE `ranking`.`mark` > $mark ORDER BY `ranking`.`mark`, `ranking`.`id` DESC";
            $result = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        if ($result -> rowCount() > 0) {
            $rank = ($result -> rowCount()) + 1;
        } else {
            $rank = 1;
        }

        return $rank;
    }

    public function createRankingMark($mark, $corrects, $errors, $blanks)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();

        try {
            $SQL = "INSERT INTO `englishb_prepared`.`ranking` (`mark`, `correct`, `incorrect`, `blanks`) VALUES ($mark, $corrects, $errors, $blanks)";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }

}
?>