<?php

class ConnectDB {
    private static $host = '127.0.0.1';
    private static $port = '3306';
    private static $db_name = '68pm34';
    private static $username = 'root';
    private static $password = '123456';
    public static $conn;

    public static function connect() {

        $conn = null;

        try {

            $conn = new PDO(
                'mysql:host=' . self::$host .
                ';port=' . self::$port .
                ';dbname=' . self::$db_name .
                ';charset=utf8',
                self::$username,
                self::$password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $e) {

            echo 'Lỗi kết nối: ' . $e->getMessage();

        }

        return $conn;
    }
}

?>