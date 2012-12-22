<?php
include ('DataBaseConnection.php');

class GestionLogin {

    public function createUser($loginName, $plainPassword)
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $passwordCod = md5($plainPassword);
            $SQL = "INSERT INTO `englishbeprepared`.`users` (`user`, `password`) VALUES ('$loginName', '$passwordCod')";
            $result = $connection -> exec($SQL);
        } catch(PDOException $e) {
            $connection -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $result;
    }
}
?>