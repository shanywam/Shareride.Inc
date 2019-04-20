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
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../driver/drive.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-car"></i> Drive <span class="sr-only">(current)</span></a>
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
            <h1><span style="color: #00b6bd;font-family: 'Dosis', sans-serif;">Ride with Shareride.Inc</span></h1>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Use Shareride.Inc to get rides in minutes</span></p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Pick the ride you need, then a registered driver will be their to take you to wherever you want.</span> </p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">The rides are smooth as they can be with minimal interference.</span></p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Try today and be the first to experience what we have to offer</span></p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Riding with Shareride.Inc is different because we are locally-based in Nairobi. We treat our client with recpect and car&#8217;e .</span></p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col"><br><br>
            <h1><span style="color: #00b6bd;font-family: 'Dosis', sans-serif;">Our Drivers</span></h1>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Our drives are very professional in what they do</span></p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">They are licenced and registered to to drive clients to where they wan to go,</span><p>
            <p><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">They are also very trustworthy </span></p>
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
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">>Shareride.Inc is a ride hailing website based in Nairobi, Kenya.</h><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">we provide safe and reliable transport in the city of Nairobi.</h><br/>
                        <br/><br/>

                    </div>
                    <div class="col-sm">
                        <b><h>Services</h></b><br/><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">Register to be a driver</h><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">Book for a ride</h><br/>

                    </div>
                    <div class="col-sm">
                        <b><h>Contacts</h></b><br/><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">+254 71 958 2000</h><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">+254 70 765 8859 </h><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">+254 72 086 3269</h><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">+254 71 442 8358 </h><br/>
                        <br/><br/>
                    </div>
                    <div class="col-sm">
                        <b><h>Emails</h></b><br/><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">pnjeru_@shareride.com</h>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">nshawn@shareride.com</h>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">lnnderitu@shareride.com</h>
                        <br/><br/>

                        <br/><br/><br/><br/><br/>
                        <p style="float:right"><font size="-1"><span style="font-family: 'Dancing Script', cursive;">2019 Shareride.Inc?</span></font></p>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm">
                        <center><p><font size="-1"><span style="font-family: 'Dancing Script', cursive;">Privacy  Terms  Legal  Site Map  Site Feedback</span></font></p></center>
                    </div>
                    <div class="col-sm">
                    </div>
                </div>
            </div>
        </div>

</body>
</html>