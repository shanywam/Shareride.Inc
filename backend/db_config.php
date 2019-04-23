<?php
class DbConfig
{
    // database connection variables
    private $host = "127.0.0.1";
    private $username = "shareride";
    private $password = "secret";
    private $database = "shareride";
    private $port = "3306";

    public $conn;

    // database connection function
    public function connect()
    {
        try{
            $this->conn = mysqli_connect("127.0.0.1", 'shareride', 'secret', 'shareride', '3306');
        }catch(mysqli_sql_exception $exception){
            echo "Connection error" . $exception->getMessage();
        }
        return $this->conn;
    }
}
