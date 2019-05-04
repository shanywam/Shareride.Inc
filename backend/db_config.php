<?php

class Database
{
    // database connection variables
    private $host = "127.0.0.1";
    private $username = "shareride";
    private $password = "secret";
    private $database = "shareride";
    private $port = "3306";

    public $conn;

    // database connection function
    public function dbConnect()
    {
        $this->conn = null;

        try {

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);

        } catch (mysqli_sql_exception $exception) {

            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

