<?php

class Helper {
    
    private $message;
    private static $instance;
    
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
    }
    
    public function getMessage () {
        if (isset($this->message)) {
        $message = implode("</br>", $this->message);
        return $message;
        }
    } 
    
    public function setMessage ($value) {
        $this->message [] = $value;
    }
}
