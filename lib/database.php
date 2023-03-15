<?php

class DBContext
{

    private static $connection;

    private function __construct()
    {
    }

    public static function connect()
    {
        if (self::$connection == null) {
            try {
                $connectionString = "mysql:host=" . constant('HOST') . ";dbname=" . constant('BD') . ";charset=utf8mb4";
                self::$connection = new PDO($connectionString, constant('USER'), constant('PASSWORD'));
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $th) {
                print_r("ERROR: " . $th->getMessage());
            }
        }
        return self::$connection;
    }
}
