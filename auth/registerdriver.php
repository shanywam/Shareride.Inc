<?php
session_start();

/*require_once('../backend/auth.php');

$reg_user = new Auth();

if ($reg_user->is_logged_in()) {
    if ($_SESSION['user_type'] == 1) {
        $reg_user->redirect('../driver/driver_page.php');
    } else {
        $reg_user->redirect('../client/client_page.php');
    }
}


$name  = $phone = $origin = $destination = $capacity of vehicle = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Form
    if (
        empty(trim($_POST["name"]))
        && empty(trim($_POST["phone"]))
        && empty(trim($_POST["origin"]))
        && empty(trim($_POST["destination"]))
        && empty(trim($_POST["capacity of vehicle"]))

    ) {
        $form_error = " Fill form.";
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



    // If no errors submit form
   {

        $email = $_POST["email"];

        $stmt = $reg_user->runQuery("SELECT * FROM users WHERE email = '$email'");

        mysqli_stmt_execute($stmt);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {[-+3
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
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/registerdriver.php"><i style ="color:darkgrey;"class="fa fa-"></i> Register Driver<span class="sr-only">(current)</span> </a>
            </li>
        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>


<div class="container">
    <div class="wrapper">
        <h3 class="text-center">Welcome to Shareride.Inc</h3>

        <p class="text-center">Fill form .</p>

        <p class="text-center help-block" style="color: red;"><?php echo $form_error ?></p>

        <form style="width: 400px;background: #fcfcfc;margin: 70px auto;">
            <div class="form-group" >
                <label for="formGroupExampleInput">Name</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Phone</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone no">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Origin</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Pick up point">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Destination</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Where to">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">Capacity of Vehicle</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Capacity of Vehicle">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
</html>