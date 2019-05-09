<?php
session_start();

include('../backend/auth.php');

$reg_user = new Auth();

if ($reg_user->is_logged_in()) {
    if ($_SESSION['user_type'] == 1) {
        $reg_user->redirect('../driver/drive.php');
    } else {
        $reg_user->redirect('../client/ride.php');
    }
}


$first_name = $last_name = $email = $phone =$password = $confirm_password = $form_error = "";
$first_name_err = $last_name_err = $email_err = $phone_err = $password_err = $confirm_password_err = $form_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate inputs if empty
    if (
        empty(trim($_POST["first_name"]))
        && empty(trim($_POST["last_name"]))
        && empty(trim($_POST["email"]))
        && empty(trim($_POST["phone"]))
        && empty(trim($_POST["password"]))
        && empty(trim($_POST["confirm_password"]))
    ) {
        $form_error = "Please fill the form before submitting.";
    }

    // Validate Password
    if (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    }elseif (strlen(trim($_POST["confirm_password"])) < 6) {
        $password_err = "Confirm Password must have at least 6 characters.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);

        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }


    // If no errors submit form
    if (
        empty($first_name_err) &&
        empty($last_name_err) &&
        empty($email_err) &&
        empty($phone_err) &&
        empty($password_err) &&
        empty($confirm_password_err)
    ) {
        $email = $_POST["email"];

        $stmt = $reg_user->runQuery("SELECT * FROM users WHERE email = '$email'");

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {

            $email_err = "This user email provided already exists.";

        } else {

            $first_name = trim($_POST["first_name"]);
            $last_name = trim($_POST["last_name"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $pass = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);

            if ($reg_user->register($first_name, $last_name, $email, $phone, $pass, 1)){
                header("location: login.php");
            }else{
                $form_err = "Please check your details are correct";
            }



        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href ="../css/bootstrap.min.css"/>
    <script src="../https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src ="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Shareride.Inc &#8211; Kenya&#039;s Taxi App &#8211; Based in Nairobi</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Dosis|PT+Sans+Narrow" rel="stylesheet">


    <title>Shareride.Inc &#8211; Kenya&#039;s Taxi App &#8211; Based in Nairobi</title>

    <link rel="stylesheet" href="../style/main.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Shareride.Inc</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="main-header-nav" class="collapse navbar-collapse">

        <ul id="menu-main-nav" class="nav navbar-nav main-nav underlined weight-light">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/register.php"><i style ="color:darkgrey;font-family: 'Merienda', cursive;"class="fa fa-"></i> Register <span class="sr-only">(current)</span> </a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/login.php"><i style ="color:darkgrey;font-family: 'Merienda', cursive;"class="fa fa-"></i> Login <span class="sr-only">(current)</span> </a>
            </li>
        </ul>


    </div>
</nav>


<div class="container">
    <div class="wrapper">
        <h2 class="text-center" style ="color: #00b6bd";>shareride</h2>

        <p class="text-center">Please fill this form to create an account.</p>

        <p class="text-center help-block" style="color: red;"><?php echo $form_error ?></p>

        <form action="register.php" method="post">

            <div class="<?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                <!--                <label>First Name: </label>-->
                <input type="text" name="first_name" class="input" placeholder="First Name"
                       value="<?php echo $first_name; ?>">
                <span class="help-block text-center"><?php echo $first_name_err; ?></span>
            </div>

            <div class="<?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Last Name: </label>-->
                <input type="text" name="last_name" class="input" placeholder="Last Name"
                       value="<?php echo $last_name; ?>">
                <span class="help-block text-center"><?php echo $last_name_err; ?></span>
            </div>

            <div class="<?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Email: </label>-->
                <input type="email" name="email" class="input" placeholder="example@gmail.com"
                       value="<?php echo $email; ?>">
                <span class="help-block text-center"><?php echo $email_err; ?></span>
            </div>

            <div class="<?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Phone: </label>-->
                <input type="text" name="phone" class="input" placeholder="phone no"
                       value="<?php echo $phone; ?>">
                <span class="help-block text-center"><?php echo $phone_err; ?></span>
            </div>

            <div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Password: </label>-->
                <input type="password" name="password" class="input" placeholder="password"
                       value="<?php echo $password; ?>">
                <span class="help-block text-center"><?php echo $password_err; ?></span>
            </div>

            <div class="<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Confirm Password: </label>-->
                <input type="password" name="confirm_password" class="input" placeholder="confirm password"
                       value="<?php echo $confirm_password; ?>">
                <span class="help-block text-center"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="">
                <input type="submit" class="btn btn-primary input" value="Submit">
            </div>
            <p class="text-center">Already have an account? <a href="login.php">LOGIN HERE</a>.</p>
        </form>
    </div>
</div>
</body>
</html>


