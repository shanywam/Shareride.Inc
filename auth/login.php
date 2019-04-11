<?php
session_start();

//require_once '../backend/auth.php';

//$logged_user = new Connect();

//if ($logged_user->is_logged_in()) {
   // if ($_SESSION['user_type'] == 1) {
   //     $logged_user->redirect('../driver/drive.php');
    //} else {
    //    $logged_user->redirect('../client/ride.php');
   // }
//}

$email = $password = "";
$user_type = null;
$email_err = $password_err = $form_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email and password are empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please provide an email to continue.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials on DB;
    if (empty($email_err) && empty($password_err)) {
        if ($logged_user->login($email, $password)) {

            if ($_SESSION['user_type'] == 1) {
                // admin/ event planner
                $logged_user->redirect('../driver/drive.php');
            } elseif ($_SESSION['user_type'] == 2) {
                // customer
                $logged_user->redirect('../client/ride.php');
            }
        }else{
            $form_err = "Please check your details are correct";
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
                <a class="nav-link" href="../auth/register.php"><i style ="color:darkgrey;"class="fa fa-"></i> Register <span class="sr-only">(current)</span> </a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/login.php"><i style ="color:darkgrey;"class="fa fa-"></i> Login <span class="sr-only">(current)</span> </a>
            </li>
        </ul>

    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>

<div class="container">
    <div class="wrapper">
        <h2 class="text-center">Welcome to Shareride.Inc</h2>
        <p class="text-center" style="color: red;"><?php echo $form_err ?></p>
        <form action="login.php" method="post">
            <div class=" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Email</label>-->
                <input type="email" name="email" class="input" placeholder="Email Address"
                       value="<?php echo $email; ?>">
                <span class="help-block" style="text-align: center;"><?php echo $email_err; ?></span>
            </div>
            <div class=" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <!--                <label>Password</label>-->
                <input type="password" name="password" placeholder="password" class="input">
                <span class="help-block" style="text-align: center;"><?php echo $password_err; ?></span>
            </div>
            <div class="">
                <input type="submit" class="btn btn-primary input" value="Login">
            </div>
            <p class="text-center">Don't have an account? <a href="register.php">REGISTER</a>.</p>
        </form>
    </div>
</div>
</body>
</html>

