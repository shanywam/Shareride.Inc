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
            }
        }
        public function runQuery($sql)
            {
                return mysqli_prepare($this->conn, $sql);
            }


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
    public function ClientInformation($userId)
    {
        try {
            $stmt = $this->runQuery("SELECT * FROM users WHERE id = $userId");

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                return $row;
            }

        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function editClientInformation($user_id, $fname, $lname, $mail)
    {
        try {
            $stmt = $this->runQuery("UPDATE users SET first_name = '$fname', last_name = '$lname', email = '$mail'WHERE id='$user_id'");

            if (mysqli_stmt_execute($stmt)) {
                return true;
            }

            return false;
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }
    public function editUserPassword($user_id, $p_pass, $new_pass)
    {
        $stmt = $this->runQuery("SELECT password FROM users WHERE id = '$user_id'");

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $hashed_pass);

                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($p_pass, $hashed_pass)) {
                        $stmt = $this->runQuery("UPDATE users SET password = '$new_pass' WHERE id='$user_id'");

                        if (mysqli_stmt_execute($stmt)) {
                            return true;
                        }

                        return false;
                    }
                }
            }
        }
    }
    public function deleteAccount($userId)
    {
        $deleted_date = date("Y/m/d"); // today's date

        $stmt = $this->runQuery("UPDATE users SET deleted_at = '$deleted_date' WHERE id='$userId'");

        if (mysqli_stmt_execute($stmt)) {
            return true;
        }

        return false;
    }
    public function countUserEvents($userId)
    {
        $stmt = $this->runQuery("SELECT COUNT(*) AS rideCount FROM rides WHERE user_id = $userId");

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $eventCount);

        mysqli_stmt_fetch($stmt);

        return $eventCount;
    }




}
?>