<?php

class UserDataInfo {

    private $isHide;
    private $classes;
    private $message;
    private $type;
    private static $instance;

    private function __construct()
    {
        $this -> isHide = true;
        $this -> classes = array();
        $this -> message = '';
        $this->type = 'Info';
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
        trigger_error('Operación Inválida: No puedes clonar una instancia de ' . get_class($this), E_USER_ERROR);
    }
    
    public function isHide()
    {
        return $this->isHide;
    }
    
    public function getClasses()
    {
        $classes = implode(' ', $this->classes);

        return $classes;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setIsHide($option)
    {
        $this->isHide = $option;
    }
    
    public function setMessage($msg)
    {
        $this->message = $msg;
    }
    
    public function setClasses($classes)
    {
        $this->classes = $classes;
    }
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function resetInstance()
    {
        $this -> isHide = true;
        $this -> classes = array();
        $this -> message = '';
        $this->type = 'Info';
    }

}
?>