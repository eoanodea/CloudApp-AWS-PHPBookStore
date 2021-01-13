<?php
class Connection {

    private static $host = "your_host";
    private static $database = "your_db";
    private static $username = "your_username";
    private static $password = "your_password";

    public static function getInstance() {
        $dsn = 'mysql:host=' . Connection::$host . ';dbname=' . Connection::$database;

        $connection = new PDO($dsn, Connection::$username, Connection::$password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

}
