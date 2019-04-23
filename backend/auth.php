<?php
include "db_config.php";
class  User
{
    public $conn;

    public function __construct()
    {
        $db = new Dbconfig();
        $this->conn = $db->connect();
    }

    public function runQuery($sql)
    {
        return mysqli_prepare($this->conn, $sql);
    }

    /*** for registration process ***/
    public function reg_user($firstname, $lastname, $email, $password, $confirm_password)
    {
        $param_password = password_hash($password, PASSWORD_DEFAULT);


        $sql = "SELECT * FROM users WHERE  email='$email'";

        //checking if the  email is available inz db
        $check = $this->conn->query($sql);
        $count_row = $check->num_rows;


        //if the email is not in db then insert to the table
        if ($count_row == 0) {

            $sql1 = "INSERT INTO users (firstname,lastname,email,password,confirm_password,user_type_id) 
                                VALUES ('$firstname','$lastname','$email','$param_password',2)";

            $result = mysqli_query($this->conn, $sql1);

            return $result;
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
        $sql2 = "SELECT id, email , password, user_type_id FROM users WHERE email= '$email' ";

        $result = mysqli_prepare($this->conn, $sql2);

            if (mysqli_stmt_execute($result))
            {
                //store result
                mysqli_stmt_store_result($result);

                //check email if exist
                if (mysqli_stmt_num_rows($result) == 1) {
                    //bind result
                    mysqli_stmt_bind_result($result, $id, $email, $hashed_password, $user_type);

                    if (mysqli_stmt_fetch($result)) {
                        //echo $password . ' ' .$hashed_password;

                       if ( password_verify($password, $hashed_password)){
                           return true;
                       };

                       return false;
                    }
                }
                $user_data = 'num_rows';
                if (!empty($user_data->num_rows)) {
                    $count_row = $user_data->num_rows;
                }

                //if ($count_row == 0) {
                // this login var will use for the session thing
                //session variables
                $_SESSION["login"] = true;
                $_SESSION['email'] = $email;
                $_SESSION["user_type"] = $user_type;
                //$_SESSION['uid'] = $user_data;
                return true;

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