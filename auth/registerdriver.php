<?php
/*session_start();

require_once('../backend/auth.php');

$reg_user = new Auth();

if ($reg_user->is_logged_in()) {
    if ($_SESSION['user_type'] == 1) {
        $reg_user->redirect('../admin/admin_page.php');
    } else {
        $reg_user->redirect('../client/client_page.php');
    }
}


$name  = $email = $phone = $password = $confirm_password = $form_error = "";
$name_err = $email_err = $phone_err = $password_err = $confirm_password_err = $form_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Form
    if (
        empty(trim($_POST["name"]))
        && empty(trim($_POST["email"]))
        && empty(trim($_POST["phone"]))
        && empty(trim($_POST["password"]))
        && empty(trim($_POST["confirm_password"]))
    ) {
        $form_error = "Please fill the form before submitting.";
    }
    // Validate name
    if (strlen(trim($_POST["name"])) < 6) {
        $name_err = "name must have at least 6 characters.";
    }
    // Validate Password
    if (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // If no errors submit form
    if (
        empty($name_err) &&
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
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $phone = trim($_POST["phone"]);
            $pass = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);

            if ($reg_user->register($name,  $email, $phone, $pass, 2)){
                $this->redirect("../auth/login.php");
            }else{
                $form_err = "Please check your details are correct";
            }
        }
    }
}*/
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
            <li class="nav-item active">
                <a class="nav-link" href="../auth/register.php"><i style ="color:darkgrey;"class="fa fa-user"></i> Ride with Shareride <span class="sr-only">(current)</span> </a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/registerdriver.php"><i style ="color:darkgrey;"class="fa fa-car"></i> Register Driver<span class="sr-only">(current)</span> </a>
            </li>

        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>


<div class="container">
    <div class="wrapper">
        <h3 class="text-center">Welcome to Shareride.Inc</h3>

        <p class="text-center">Please fill this form to create an account.</p>

        <p class="text-center help-block" style="color: red;"><?php echo $form_error ?></p>

        <form action="registerdriver.php" method="post">

            <div class="<?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <!--                <label>First Name: </label>-->
                <input type="text" name="name" class="input" placeholder=" Name"
                       value="<?php echo $name; ?>">
                <span class="help-block text-center"><?php echo $name_err; ?></span>
            </div>


            <div class="<?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Email: </label>-->
                <input type="email" name="email" class="input" placeholder="example@gmail.com"
                       value="<?php echo $email; ?>">
                <span class="help-block text-center"><?php echo $email_err; ?></span>
            </div>

            <div class="<?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Phone: </label>-->
                <input type="text" name="phone" class="input" placeholder="0722000000"
                       value="<?php echo $phone; ?>">
                <span class="help-block text-center"><?php echo $phone_err; ?></span>
            </div>

            <div class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Password: </label>-->
                <input type="password" name="password" class="input" placeholder="*******"
                       value="<?php echo $password; ?>">
                <span class="help-block text-center"><?php echo $password_err; ?></span>
            </div>

            <div class="<?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Confirm Password: </label>-->
                <input type="password" name="confirm_password" class="input" placeholder="*******"
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