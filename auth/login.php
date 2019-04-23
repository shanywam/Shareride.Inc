<?php
session_start();

include_once '../backend/auth.php';
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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


    if ($user->check_login($email, $password)){
        $user->redirect('driver/drive.php');
        $user->redirect('client/ride.php');

    }else{
        echo "not logged in";
    }





}



if (isset($_REQUEST['submit']))
{
    extract($_REQUEST);

    $login = $user->check_login($email, $password);

    if ($login ['user_type_id'] == 1) {
        //Registration Success
        header("../location:drive.php");
    } elseif ($login ['user_type_id'] == 2) {
        header("../location:ride.php");
    } else {
        $form_err = "Please check your details are correct";
    }
}

$email = $password = "";
$user_type_id = 'user_type_id';
$email_err = $password_err = $form_err = "";


//close statement
//mysqli_stmt_close($result);

//close connection
//mysqli_close($conn)

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
        <p class="text-center" style="color: red;"></p>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <style><!--
            #container{width:400px; margin: 0 auto;}
            --></style>
        <script type="text/javascript">
            function submitlogin()
            {
                var form = document.login;
                if(form.email.value == "")
                {
                    alert( "Enter email or username." );
                    return false;
                }
                else if(form.password.value == "")
                {
                    alert( "Enter password." );
                    return false;
                }
            }
        </script>
        <span style="font-family: 'Courier 10 Pitch', Courier, monospace; font-size: 13px; font-style: normal; line-height: 1.5;"><div id="container"></span>
        <h3>Login Here</h3>
        <form action="login.php" method="post" name="">
            <table>
                <tbody>
                <tr>
                    <th class="text-center">Email:</th>
                    <td><input type="text" name="email" required="" /></td>
                </tr>
                <tr>
                    <th class="text-center">Password:</th>
                    <td><input type="password" name="password" required="" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input onclick="return(submitlogin());" type="submit" name="submit" value="Login" /></td>
                    <?php
                    $user_type_id ='user_type_id';
                    if ($user_type_id == 1) {
                        //driver
                        header("location: drive.php");
                    } elseif($user_type_id == 2){
                        //client
                        header("location: ride.php");
                    }
                    ?>
                </tr>
                <tr>
                    <td></td>
                    <td><a href="register.php">Register new user</a></td>
                </tr>
                </tbody>
            </table>
        </form></div>
</div>
</div>
</body>
</html>