<?php
class Connection {

    private static $host = "bookstoresampledb.c1loew3e2yv5.us-east-1.rds.amazonaws.com";
    private static $database = "bookstoresample_db";
    private static $username = "admin";
    private static $password = "secretBS";

    public static function getInstance() {
        $dsn = 'mysql:host=' . Connection::$host . ';dbname=' . Connection::$database;

        $connection = new PDO($dsn, Connection::$username, Connection::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}
