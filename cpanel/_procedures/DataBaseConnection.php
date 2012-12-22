<?php

class DataBaseConnection {

    private $connection;
    private $hostname;
    private $username;
    private $password;
    private $dbName;
    private static $instance;

    private function __construct()
    {
        $this -> connection = null;
        $this -> hostname = "localhost";
        $this -> username = "dev";
        $this -> password = "dxs.24";
        $this -> dbName = "englishbeprepared";
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

    public function __wakeup()
    {
        trigger_error("No puedes deserializar una instancia de " . get_class($this) . " class.");
    }

    public function createConnection()
    {
        try {
            $connection = new PDO("mysql:host=" . $this -> hostname . ";dbname=" . $this -> dbName, $this -> username, $this -> password);
            $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection -> query('SET NAMES utf8');

        } catch(PDOException $err_conexion) {

            Header("Location:error.php");

        }
        return $connection;
    }

    public function closeConnection()
    {
        $this->conexion = null;
    }

}
?>