<?php
class DBconnect {
    public static $db = false;
    
    public function connect($db_type, $db_host, $db_user, $db_pass, $db_name) {
        $dsn = $db_type . ':dbname=' . $db_name . ';host=' . $db_host;
        try {
            self::$db = new PDO($dsn, $db_user, $db_pass, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'DB Error';
        }
    }
}
