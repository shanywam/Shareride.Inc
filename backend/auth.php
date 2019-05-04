<?php

require_once 'db_config.php';

class Auth
{
    private $conn;
    private $email_err;
    private $password_err;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnect();
        $this->conn = $db;
        $this->email_err = $this->password_err = '';
    }

    public function runQuery($sql)
    {

        return mysqli_prepare($this->conn, $sql);
    }

    //function for the registration of the users
    public function register($first_name, $last_name, $email, $phone, $password, $user_type)
    {
        //var_dump($first_name, $last_name, $email, $phone, $password, $user_type);
        try {
            $stmt = $this->runQuery("INSERT INTO users(first_name, last_name, email, phone,  password, user_type)
                  VALUES('$first_name', '$last_name', '$email', '$phone', '$password' ,$user_type)");


           // var_dump(mysqli_stmt_execute($stmt));

            if (mysqli_stmt_execute($stmt)) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
        }
    }

    //function for user login
    public function login($email, $pass)
    {
        try {
            $stmt = $this->runQuery("SELECT id, email, password, user_type FROM users WHERE email = '$email' AND deleted_at IS NULL OR deleted_at = ''");

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $user_type);

                    if (mysqli_stmt_fetch($stmt)) {
                        // Password is correct, so start a new session
                        if (password_verify($pass, $hashed_password)) {
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["user_type"] = $user_type;

                            return true;
                        } else {
                            $this->password_err = "The password you entered was not valid.";
                            return false;
                        }
                    }
                } else {
                    $this->email_err = "No account found with that email address.";
                    return false;
                }
            }

        } catch (mysqli_sql_exception $ex) {
            echo $ex->getMessage();
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

    public function logout()
    {
        session_destroy();

        $_SESSION['loggedin'] = false;
    }
}
?>