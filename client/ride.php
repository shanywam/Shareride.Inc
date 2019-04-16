<?php
session_start();

require_once '../backend/auth.php';

$logged_user = new User();

//if (!$logged_user->is_logged_in()) {
    //$logged_user->redirect('../index.php');
//} else {
  //  if ($_SESSION['user_type'] == 1) {
   //     $logged_user->redirect('../driver/drive.php');
   // }
//}

$active_page = 'ride';
$form_active = $edit_profile = $edit_password = $delete_account = $add_amount_form = false;
$name = $phone = $origin = $destination = $capacity_of_vehicle = $delete_error  = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['page']) && $_POST['page'] === 'events') {
        $active_page = 'events';
    } elseif (isset($_POST['page']) && $_POST['page'] === 'profile') {
        $active_page = 'profile';
    } elseif (isset($_POST["form_active"])) {
        $form_active = true;
    } elseif (isset($_POST['event_form'])) { //save new details

    } elseif (isset($_POST['event_delete'])) { //soft delete existing details


    } elseif (isset($_POST['event_edit'])) { // edit existing details
        $form_active = true;
        $event_id = $_POST['event_id'];

        if ($details = $logged_user->showEditRequestDetails($_POST['event_id'])) {
            $form_submitted = "edit";

            $event_id = $details['id'];
            $event_name = $details['name'];
            $event_location = $details['location'];
            $event_date = $details['date'];
            $event_people = $details['people_count'];
            $event_costs = $details['total_cost'];
        }

    } elseif (isset($_POST['show_edit_profile'])) { // show edit profile page
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

        if ($logged_user->ClientInformation($user_id, $fname, $lname, $mail, $phone)) {
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
    }elseif (isset($_POST['notification_event'])){
        $action = $_POST['notification_event'];
        $active_page = 'notification';


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
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;font-family: 'Merienda', cursive;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../driver/drive.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-car"></i> Drive <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;font-family: 'Merienda', cursive; "class="fa fa-user"></i> Ride <span class="sr-only">(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../client/rideform.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-"></i> Request Ride <span class="sr-only">(current)</span> </a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/logout.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-"></i> Logout <span class="sr-only">(current)</span> </a>
            </li>
        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/driver.jpg" class="d-block w-100" alt="..." style="height:400px;width:50%;color:rgba(255,255,255,1);border-radius:20px ">
                    </div>

                </div>
            </div>
        </div>
        <div class="col"><br><br>
            <h1><span style="color: black;">Ride with Shareride.Inc</span></h1>
            <p>Use Shareride.Inc to get rides in minutes</p>
            <p>Pick the ride you need, then a registered driver will be their to take you to wherever you want. </p>
            <p>The rides are smooth as they can be with minimal interference.</p>
            <p>Try today and be the first to experience what we have to offer</p>
            <p>Riding with Shareride.Inc is different because we are locally-based in Nairobi. We treat our client with recpect and car&#8217;e .</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col"><br><br>
            <h1><span style="color: black;">Our Drivers</span></h1>
            <p>Our drives are very professional in what they do</p>
            <p>They are licenced and registered to to drive clients to where they wan to go<p>
            <p>They are also very trustworthy </p>
        </div>
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/taxi.jpg" class="d-block w-100" alt="..." style="height:400px;width:50%;color:rgba(255,255,255,1);border-radius:20px ">
                    </div>

                </div>
            </div>
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
>
</html>