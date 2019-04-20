<?php

class DbConfig
{
    public $conn;

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
