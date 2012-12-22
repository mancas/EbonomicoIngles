<?php

include_once ('DataBaseConnection.php');

class UserLogin {
    
    protected $user;
    protected $password;
    private static $instance;
    
    private function __construct(){
        $this->user = '';
        $this->password = '';
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
    
    public function getUser()
    {
        return $this->user;
    }
    
    public function setUser($user)
    {
        $this->user = $user;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getUserCredentials()
    {
        $instance = DataBaseConnection::getInstance();
        $connection = $instance -> createConnection();
        try {
            $loginName = $this->getUser();
            $plainPassword = $this->getPassword();
            $passwordCod = md5($plainPassword);

            $SQL = "SELECT * FROM `englishbeprepared`.`users` WHERE `user` = '$loginName' AND `password` = '$passwordCod'";
            $user = $connection -> query($SQL);
        } catch(PDOException $e) {
            $instance -> closeConnection();
            return false;
        }
        $instance -> closeConnection();

        return $user;
    }

}
?>