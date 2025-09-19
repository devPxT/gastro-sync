<?php

class DbConnection
{
    private static ?DbConnection $instance = null;
    private ?mysqli $connection = null;

    private function __construct()
    {
        $host = 'localhost';
        $user = 'your_db_user';
        $password = 'your_db_password';
        $database = 'your_db_name';

        $this->connection = new mysqli($host, $user, $password, $database);

        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }
    }

    public static function getInstance(): DbConnection
    {
        if (self::$instance === null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    private function __clone() {}
    private function __wakeup() {}
}