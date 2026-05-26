<?php

class ConnectDB {

    private static $server = 'LAPTOP-B7Q5H0D0';
    private static $database = '68PM34';

    public static $conn;

    public static function connect() {

        $conn = null;

        try {

            $conn = new PDO(
                "sqlsrv:Server=" . self::$server . ";Database=" . self::$database . ";Trusted_Connection=yes;"
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