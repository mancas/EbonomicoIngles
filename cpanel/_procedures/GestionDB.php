<?php

include ('DataBaseConnection.php');

class GestionDB {

    public function getListadoBanners()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $SQL = "SELECT * FROM `englishbeprepared`.`banner`";
            $banners = $connection -> query($SQL);
        } catch(PDOException $e) {
            $connection -> closeConnection();
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
            $SQL = "SELECT `banner`.`path` FROM `englishbeprepared`.`banner` WHERE `banner`.`id` = $id";
            $bannerPath = $connection -> query($SQL);
            $SQL = "DELETE FROM `englishbeprepared`.`banner` WHERE `banner`.`id` = $id";
            $res = $connection -> exec($SQL);

            $result['path'] = $bannerPath;
            $result['OK'] = $res;

        } catch(PDOException $e) {
            $connection -> closeConnection();
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
            $SQL = "UPDATE `englishbeprepared`.`banner` SET `banner`.`active` = '$value', `banner`.`posicion` = 'NULL' WHERE `banner`.`id` = $id";
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
            $SQL = "UPDATE `englishbeprepared`.`banner` SET `banner`.`posicion` = '$value' WHERE `banner`.`id` = $id";
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
            $SQL = "SELECT * FROM `englishbeprepared`.`users`";
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
            $SQL = "DELETE FROM `englishbeprepared`.`users` WHERE `users`.`id` = $id";
            $result = $connection -> exec($SQL);

        } catch(PDOException $e) {
            $connection -> closeConnection();
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
            $SQL = "UPDATE `englishbeprepared`.`users` SET `users`.`password` = '$passwordCod' WHERE `users`.`id` = $id";
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