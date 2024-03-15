<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__FILE__)."/db_config.php";

class Database {
    protected $conn;

    public function __construct() {
        try {
            $this -> conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this-> conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

?>
