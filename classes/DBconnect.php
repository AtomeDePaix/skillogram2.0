<?php

class DBconnect {
    
    private $db;
    private static $instance; 
    private static $db_type;  
    private static $db_host;
    private static $db_user;
    private static $db_pass; 
    private static $db_name;
    
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $db_type = self::$db_type;
        $db_host = self::$db_host;
        $db_user = self::$db_user;
        $db_pass = self::$db_pass; 
        $db_name = self::$db_name;
        $dsn = $db_type . ':dbname=' . $db_name . ';host=' . $db_host;
        try {
            $this->db = new PDO($dsn, $db_user, $db_pass, [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            $helper = Helper::getInstance();
            $message = $helper->setMessage("DB Error!");
            exit;
        }
    }
    
    public static function setDbType($db_type) {
        self::$db_type = $db_type;
    }
    
    public static function setDbHost($db_host) {
        self::$db_host = $db_host;
    }
    
    public static function setDbUser($db_user) {
        self::$db_user = $db_user;
    }
    
    public static function setDbPass($db_pass) {
        self::$db_pass = $db_pass;
    }
    
    public static function setDbName($db_name) {
       self::$db_name = $db_name;
    }
    
    public function getConnection() {
       return $this->db;
    }
}
