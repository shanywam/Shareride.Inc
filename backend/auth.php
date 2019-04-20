<?php

include "db_config.php";

class User
{

    public $conn;

    public function __construct()
    {
        $db = new DbConfig();

        $this->conn = $db->connect();
    }

    public function runQuery($sql)
    {
        return mysqli_prepare($this->conn, $sql);
    }


    /*** for registration process ***/
    public function reg_user($firstname, $lastname, $email, $password, $confirm_password)
    {

        $password = md5($password);
        $confirm_password = md5($confirm_password);

        $sql = "SELECT * FROM users WHERE  email='$email'";
        //checking if the  email is available inz db

        $check = $this->conn->query($sql);
        $count_row = $check->num_rows;

        //var_dump($check);
        // var_dump($count_row);

        //if the email is not in db then insert to the table
        if ($count_row == 0) {
            //var_dump("$firstname");

            $sql1 = "INSERT INTO users (firstname,lastname,email,password,confirm_password,user_type_id) 
                            VALUES ('$firstname','$lastname','$email','$password','$confirm_password','2')";
            //var_dump($sql1);
            $result = mysqli_query($this->conn, $sql1) or die(mysqli_connect_errno() . " something went wrong");
            return $result;

            //var_dump($sql1);

        } else {
            return false;
        }

    }

    public function is_logged_in()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            return true;
        } else {
            return false;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    /*** for login process ***/

    public function check_login($email, $password)
    {

        $sql2 = "SELECT id, email , password, user_type_id FROM users WHERE email='$email'";



        $result = mysqli_query($this->conn, $sql2);
        //$mysqli_result = mysqli_fetch_array($result);


        $user_data = 'num_rows';

        if (!empty($user_data->num_rows)) {
            $count_row = $user_data->num_rows;
        }

        //if ($count_row == 0) {
            // this login var will use for the session thing


        //session variables
            $_SESSION["login"] = true;

            $_SESSION['email'] = $email;
            $_SESSION["user_type_id"] = $user_type_id;
            $_SESSION['uid'] = $user_data;
            return true;
        //} else {
           // return false;
       // }
    }

    /*** starting the session ***/

    public function get_session()
    {
        return $_SESSION['login'];
    }

    public function user_logout()
    {
        $_SESSION['login'] = FALSE;
        session_destroy();
    }
}
?>