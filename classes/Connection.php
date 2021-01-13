<?php
class Connection {

    private static $host = "localhost";
    private static $database = "cloud_bookstore_2";
    private static $username = "root";
    private static $password = "root";

    public static function getInstance() {
        $dsn = 'mysql:host=' . Connection::$host . ';dbname=' . Connection::$database;

        $connection = new PDO($dsn, Connection::$username, Connection::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}
