<?php
session_start();

require_once '../backend/auth.php';

$logged_user = new Auth();

if (!$logged_user->is_logged_in()) {
    $logged_user->redirect('../index.php');
} else {
    if ($_SESSION['user_type'] == 2) {
        $logged_user->redirect('../client/ride.php');
    }
}

$active_page = 'rides';
$latest_action = true;

$add_funds_request = $edit_task = $delete_panel = $event_sub_task = false;
$ride_action_error = $ride_action_success = $delete_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// change active pages
    if (isset($_POST['page'])) {
        $page = $_POST['page'];

        if ($page == 'events') {
            $active_page = 'rides';
        } elseif ($page == 'clients') {
            $active_page = 'clients';
        } elseif ($page == 'profile') {
            $active_page = 'profile';
        }
    }

// admin clients module action
    if (isset($_POST['delete_client'])) {
        $action = $_POST['delete_client'];
        $user_id = $_POST['user_id'];

        if ($action == 'show_panel') {
            $active_page = 'clients';
            $delete_panel = true;

            $user_details = $logged_user->ClientInformation($user_id);
        } elseif ($action == 'cancel_delete') {
            $active_page = 'ridelist';
            $delete_panel = false;
            $delete_message = "Client Delete action canceled";
        } elseif ($action == 'delete_ridelist') {
            $active_page = 'ridelist';
            $delete_panel = false;

            if ($logged_user->deleteAccount($user_id)) {
                $delete_message = "Client Delete action success";
            } else {
                $delete_message = "Something went wrong. Please try again later.";
            }
        }

    }


// profile actions
    if (isset($_POST['show_edit_profile'])) { // show edit profile page
        $edit_profile = true;
        $active_page = "profile";

    } elseif (isset($_POST['show_edit_password'])) { // show edit password page
        $edit_password = true;
        $active_page = "profile";

    } elseif (isset($_POST['show_delete_account'])) { // show delete account page
        $delete_account = true;
        $active_page = "profile";

    } elseif (isset($_POST['cancel_delete_account'])) { // cancel delete account page
        $delete_account = false;
        $active_page = "profile";

    } elseif (isset($_POST['edit_profile_details'])) { // edit profile
        $user_id = $_POST['user_id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];

        if ($logged_user->editClientInformation($user_id, $fname, $lname, $mail, $phone)) {
            $edit_profile = false;
            $active_page = "profile";
            $success_message = "Profile Details updates successfully";

        } else {
            $edit_profile = true;
            $active_page = "profile";
            $delete_error = "Something went wrong. Please try again later.";
        }
    } elseif (isset($_POST['edit_profile_password'])) { //edit password
        $user_id = $_POST['user_id'];
        $p_pass = $_POST['password_previous'];
        $n_pass = $_POST['password_new'];
        $n_pass_conf = $_POST['password_new_confirm'];


        if (strlen(trim($n_pass)) < 6 && strlen(trim($n_pass_conf)) < 6 && strlen(trim($p_pass)) < 6) {
            $edit_password = true;
            $active_page = "profile";
            $delete_error = "The passwords provided are less than 6 characters.";

        } elseif (empty($delete_error) && ($n_pass !== $n_pass_conf)) {
            $edit_password = true;
            $active_page = "profile";
            $delete_error = "The new passwords don't match, try again.";

        } else {

            $new_pass = password_hash($n_pass, PASSWORD_DEFAULT);

            if ($logged_user->editUserPassword($user_id, $p_pass, $new_pass)) {
                $active_page = "profile";
                $edit_password = false;
                $success_message = "Profile Password updates successfully";
            } else {
                $active_page = "profile";
                $edit_password = true;
                $delete_error = "Wrong Previous Password. Please try again later.";
            }

        }
    } elseif (isset($_POST['delete_account'])) { // delete account
        if ($logged_user->deleteAccount($_POST['user_id'])) {
            $_SESSION = array();
            session_destroy();

            $logged_user->redirect('../index.php');

        } else {
            $delete_error = "Something went wrong. Please try again later.";
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

    <link href="https://fonts.googleapis.com/css?family=Merienda|Open+Sans+Condensed:300|PT+Sans+Narrow" rel="stylesheet">
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
                <a class="nav-link" href="../index.php"><i style ="color:darkgrey ;font-family: 'Merienda', cursive;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../driver/drive.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-car"></i> Drive <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;font-family: 'Merienda', cursive; "class="fa fa-user"></i> Ride <span class="sr-only">(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/logout.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-r"></i> Logout <span class="sr-only">(current)</span> </a>
            </li>
        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>
<div class="topnav">
    <div class="container">
        <a href="../index.php">Home</a>

        <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo '<a href="../auth/login.php">Login</a>'
        ?>

        <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo '<a href="../auth/register.php">Register</a>'
        ?>

        <?php if ((isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) && $_SESSION['user_type'] == 1)
            echo '<a href="../driver/drive.php">Admin Dash</a>'
        ?>

        <?php if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
            echo $_SESSION["email"];
        ?>

        <?php if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
            echo '<a href="../auth/logout.php">Logout</a>'
        ?>
    </div>
</div>
<div class="container">
    <div class="dash-body">
        <div class="side-menu">
            <div id="mySidenav" class="sidenav">

                <form action="drive.php" method="post">
                    <input type="hidden" name="page" value="clients">

                    <button class="btn btn-menu-side" type="submit">Clients</button>
                </form>
                <br>
                <br>
                <form action="drive.php" method="post">
                    <input type="hidden" name="page" value="profile">

                    <button class="btn btn-menu-side" type="submit">My Profile</button>
                </form>
            </div>
        </div>

        <div class="main-content">
            <?php if ($active_page == 'clients') {
                include "ridelist.php";
            } elseif ($active_page == 'profile') {
                include "profile.php";
            } ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/driver.jpg" class="d-block w-100" alt="..." style="height:500px;width:50%;color:rgba(255,255,255,1);border-radius:20px ">
                    </div>

                </div>
            </div>
        </div>
        <div class="col">
            <h1><span style="color: #00b6bd;">Drive for Shareride.Inc</span></h1>
            <h2>We ll treat you like a professional</h2>
            <p>The difference between Shareride.Inc and other ride-sharing apps is:</p>
            <ul>
                <li><span style="font-weight: 400;">We care about the safety of our drivers.</span></li>
                <li>We care about our drivers earnings .</li>
                <li>We care about providing the best tools for our drivers .</li>
            </ul>
            <p>Driving for Shareride.Inc is different because we are locally-based in Nairobi. We relate to our drivers in a way other companies don&#8217;t .</p>

                <li class="nav-item active">
                    <a class="nav-link" href="../auth/registerdriver.php"><i style ="color:darkgrey ;"class="fa fa-"></i> To become a driver <span class="sr-only">(current)</span></a>
                </li>

        </div>

    </div>
    <div>
        <div style="background-color:rgba(211,211,211,0.5);">
            <br/><br/><br/>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <b><h>About</h></b><br/><br/>
                        <h style="color:grey">Shareride.Inc is a ride hailing website based in Nairobi, Kenya.</h><br/>
                        <h style="color:grey">we provide safe and reliable transport in the city of Nairobi.</h><br/>
                        <br/><br/>

                    </div>
                    <div class="col-sm">
                        <b><h>Services</h></b><br/><br/>
                        <h style="color:grey">Register to be a driver</h><br/>
                        <h style="color:grey">Book for a ride</h><br/>

                    </div>
                    <div class="col-sm">
                        <b><h>Contacts</h></b><br/><br/>
                        <h style="color:grey">+254 71 958 2000</h><br/>
                        <h style="color:grey">+254 70 765 8859 </h><br/>
                        <h style="color:grey">+254 72 086 3269</h><br/>
                        <h style="color:grey">+254 71 442 8358 </h><br/>
                        <br/><br/>
                    </div>
                    <div class="col-sm">
                        <b><h>Emails</h></b><br/><br/>
                        <h style="color:grey">pnjeru_@shareride.com</h>
                        <h style="color:grey">nshawn@shareride.com</h>
                        <h style="color:grey">lnnderitu@shareride.com</h>
                        <br/><br/>

                        <br/><br/><br/><br/><br/>
                        <p style="float:right"><font size="-1">2019 Shareride.Inc</font></p>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                        <center><p><font size="-1">Privacy  Terms  Legal  Site Map  Site Feedback</font></p></center>
                    </div>
                    <div class="col-sm">
                    </div>
                </div>
            </div>
        </div>

</body>
</html>