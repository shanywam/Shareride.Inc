<?php

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
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only" >(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/logout.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-"></i> Logout <span class="sr-only">(current)</span> </a>
            </li>
        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>
<!--<div class="topnav">
    <div class="container">
        <a href="../index.php">Home</a>

        <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo '<a href="../auth/login.php">Login</a>'
        ?>

        <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo '<a href="../auth/register.php">Register</a>'
        ?>

        <?php// if ((isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true) && $_SESSION['user_type'] == 1)
            echo '<a href="../driver/drive.php">drive</a>'
        ?>

        <?php if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
            echo $_SESSION["email"];
        ?>

        <?php if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
            echo '<a href="../auth/logout.php">Logout</a>'
        ?>
    </div>
</div>-->

<br><br><br>

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

            <br><br><br>

            <h1><span style="color: #00b6bd;font-family: 'Dosis', sans-serif;">Drive for Shareride.Inc</span></h1>
            <h2><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">We ll treat you like a professional</h2>
            <h6><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">The difference between Shareride.Inc and other ride-sharing apps is:</span></h6>
            <ul>
            <li><span style="font-weight: 400;font-family: 'PT Sans Narrow', sans-serif;">We care about the safety of our drivers.</span></li>
            <li><span style="font-weight: 400;font-family: 'PT Sans Narrow', sans-serif;">We care about our drivers earnings .</span></li>
            <li><span style="font-weight: 400;font-family: 'PT Sans Narrow', sans-serif;">We care about providing the best tools for our drivers .</span></li>
            </ul>
            <h6><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Driving for Shareride.Inc is different because we are locally-based in Nairobi. We relate to our drivers in a way other companies don&#8217;t .</span></h6>



        </div>
    </div>
</div>

<br><br><br>

<div class="container">
    <div class="row">

        <div class="col">

            <br><br><br><br><br>

            <h1><span style="color: #00b6bd;font-family: 'Dosis', sans-serif;"> Shareride.Inc</span></h1>

            <h6><span style="font-weight: 400;font-family: 'Dosis', sans-serif;">Drive with Shareride.Inc and earn great money as an independent contractor. In an area of your choice where it is busy thus being easy to cash in alot of money. Get paid weekly jest for helping the community of rides get rides around town. Be your own boss and get paid in fares for driving in your own schedule. </span></h6>

        </div>
        <div class="col">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../image/driver11.jpg" class="d-block w-100" alt="..." style="height:300px;width:50%;color:rgba(255,255,255,1);border-radius:20px ">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<br><br><br>

    <div>
        <div style="background-color:rgba(211,211,211,0.5);">
            <br/><br/><br/>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <b><h>About</h></b><br/><br/>
                        <h style="color:grey;font-family: 'Dancing Script', cursive;">Shareride.Inc is a ride hailing website based in Nairobi, Kenya.</h><br/>
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
                        <p style="float:right;font-family: 'Dancing Script', cursive;"><font size="-1">2019 Shareride.Inc</font></p>

                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                    </div>
                    <div class="col-sm"><span style="font-family: 'Dancing Script', cursive;">Privacy  Terms  Legal  Site Map  Site Feedback</span></font></p></center>
                    </div>
                        <center><p><font size="-1">
                    <div class="col-sm">
                    </div>
                </div>
            </div>
        </div>

</body>
</html>