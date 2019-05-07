<?php
session_start();

include('../backend/auth.php');

$book_ride = new Auth();

$origin = $destination = $vehicle_capacity = $identification  = $form_error = "";
$reservation_id = $success_message = '';
$origin_err = $destination_err = $vehicle_capacity_err = $identification_err = $form_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate inputs if empty
    if (isset($_POST['create_new'])) {

        if (
            empty(trim($_POST["origin"]))
            && empty(trim($_POST["destination"]))
            && empty(trim($_POST["vehicle_capacity"]))
            && empty(trim($_POST["identification"]))

        //var_dump($_POST);

        ) {
            $form_error = "Please fill the form before submitting.";
        }


        // If no errors submit form
        if (
            empty($origin_err) &&
            empty($destination_err) &&
            empty($vehicle_capacity_err) &&
            empty($identification_err) ) {
            $identification = $_POST["identification"];

            $stmt = $book_ride->runQuery("SELECT * FROM reservations WHERE identification = '$identification'");

            mysqli_stmt_execute($stmt);

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {

                $identification_err = "This identification number provided already exists.";

            } else {

                $origin = trim($_POST["origin"]);
                $destination = trim($_POST["destination"]);
                $vehicle_capacity = trim($_POST["vehicle_capacity"]);
                $identification = trim($_POST["identification"]);

                if ($book_ride->ride ($origin, $destination, $vehicle_capacity, $identification, 2)) {
                    header("location: ride.php");
                } else {
                    $form_err = "Please check if your details are correct";
                }

            }
        }
    }elseif (isset($_POST['edit_action'])) {

        $reservation_id = $_POST["book_id"];

        $details = $book_ride->getReservationDetails($reservation_id);

        $origin = $details['origin'];
        $destination = $details['destination'];
        $vehicle_capacity = $details['vehicle_capacity'];
        $identification = $details['identification'];

    }elseif (isset($_POST['create_edit'])) {
        
        if($book_ride->editReservation()){
            $book_ride->redirect("list.php");
            // $success_message = "Edited Successfully";
        }else{
            $form_error = "Edit process unsuccessful";
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
            <ul id="menu-main-nav" class="nav navbar-nav main-nav underlined weight-light">
                <li class="nav-item active">
                    <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../client/rideform.php"><i style ="color:darkgrey ;"class="fa fa-car"></i> RequestRide <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../client/list.php"><i style ="color:darkgrey ;"class="fa fa-list"></i>List <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../auth/logout.php"><i style ="color:darkgrey ;"class="fa fa-sign-out-alt"></i> Logout <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </ul>
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>


<div class="container">
    <div class="wrapper">
        <h3 class="text-center">Welcome to Shareride.Inc</h3>

        <p class="text-center">Fill form .</p>

        <p class="text-center help-block" style="color: red;"></p>

        <?php echo $form_error; ?>
        <?php echo $success_message; ?>

        <form style="width: 400px;background: #fcfcfc;margin: 70px auto;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="form-group">
                <label for="formGroupExampleInput2">Origin Location</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="origin" placeholder="Pick up point"  value="<?php echo $origin; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Destination Location</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="destination" placeholder="Where to" value="<?php echo $destination; ?>">
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">vehicle_capacity</label>
                <input type="text" class="form-control" id="formGroupExampleInput2"  name="vehicle_capacity" placeholder="No of people" value="<?php echo $vehicle_capacity; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">National Id</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Your ID No" name="identification" value="<?php echo $identification; ?>">
            </div>


            <?php if ($reservation_id) { ?>
               <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>" />

               <input type="hidden" name="create_edit" value="create_edit">
            <?php } else { ?>
                <input type="hidden" name="create_new" value="create_new">
            <?php } ?>

            <button type="submit" name="driverForm" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
