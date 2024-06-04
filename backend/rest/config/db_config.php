<?php
// DATABASE CONFIG

// Report all errors accept E_NOTICE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// // Database access credentials
// define("DB_HOST", "localhost:3306");
// define("DB_USER", "root");
// define("DB_PASS", "root");
// define("DB_NAME", "blog_database");

// // JWT Secret key
// define("JWT_SECRET", "LbnOaY2+QrqjakZvZrWb0yg35RJgKyQaDOMRgQ0zV");

class Config {
    public static function DB_NAME() {
        return Config::get_env("DB_NAME", "blog_database");
    }
    public static function DB_PORT() {
        return Config::get_env("DB_PORT", 3306);
    }
    public static function DB_USER() {
        return Config::get_env("DB_USER", 'root');
    }
    public static function DB_PASSWORD() {
        return Config::get_env("DB_PASSWORD", 'root');
    }
    public static function DB_HOST() {
        return Config::get_env("DB_HOST", '127.0.0.1');
    }
    public static function JWT_SECRET() {
        return Config::get_env("JWT_SECRET", 'LbnOaY2+QrqjakZvZrWb0yg35RJgKyQaDOMRgQ0zV');
    }
    public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != "" ? $_ENV[$name] : $default;
    }
}
?>