<?php

include "../backend/db_config.php";
class User
{

        public $db;

        public function __construct()
        {
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE,DB_PORT);

        if(mysqli_connect_errno())
        {
            echo "Error: Could not connect to database.";
            exit;
        }}

        /*** for registration process ***/
        public function reg_user($firstname, $lastname, $email, $password, $corfirm_password)
        {
            $password = md5($password);

            $sql = "SELECT * FROM users WHERE  email='$email'";
        //checking if the  email is available in db

            $check = $this->db->query($sql);
            $count_row = $check->num_rows;

        //if the email is not in db then insert to the table
            if ($count_row == 0)
            {
                $sql1 = "INSERT INTO users SET  pass='$password', email='$email'";
                $result = mysqli_query($this->db, $sql1) or die(mysqli_connect_errno() . "Data cannot inserted");
                return $result;
            }
            else
                {
                return false;
                }
        }

        /*** for login process ***/

        public function check_login($email, $password)
        {
        $password = md5($password);

        $sql2="SELECT user_id from users WHERE uemail='$email'  and upass='$password'";

        //checking if the username is available in the table

        $result = mysqli_query($this->db,$sql2);

        $user_data = mysqli_fetch_array($result);

        $count_row = $result->num_rows;

        if ($count_row == 1)
            {
            // this login var will use for the session thing

            $_SESSION['login'] = true;
            $_SESSION['uid'] = $user_data['uid'];
            return true;
            }

        else {
            return false;
             }
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