<?php


include('../backend/db_config.php');

$connection = new Database();

$conn = $connection->dbConnect();

if (isset($_POST['rideForm'])) {



    $origin = $_POST['origin'];

    $destination = $_POST['destination'];

    $vehicle_capacity = $_POST['vehicle_capacity'];

    $identification = $_POST['identification'];



    $type = 2;


    if (!empty($origin) && !empty($destination) && !empty($vehicle_capacity && !empty($identification)) ) {


        $results = $conn->query("SELECT * from reserevations WHERE identification='$identification'");

        $count = $results->num_rows;

        if ($count == 0) {

            $query = "INSERT into reservations(  origin, destination, vehicle_capacity, identification, client_id,  driver_id) VALUES(?, ?, ?, ?, ?, ?)";

            $statement = $conn->prepare($query);

            $statement->bind_param('ssiiii',  $origin, $destination, $capacity_of_people, $identification,$client_id, $driver_id);

            if ($statement->execute()) {

                echo "Success";

            } else {

                die('There was a problem');

            }

        } else {

            echo "Sorry the Identification Exist";
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
                <a class="nav-link" href="../client/ride.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class=" nav-item active">
                <a class="nav-link" href="../auth/logout.php"><i style ="color:darkgrey; font-family: 'Merienda', cursive;"class="fa fa-"></i> Logout <span class="sr-only">(current)</span> </a>
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

        <p class="text-center help-block" style="color: red;"></p>

        <?php
        //echo $form_error
        ?>

        <form style="width: 400px;background: #fcfcfc;margin: 70px auto;" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div class="form-group">
                <label for="formGroupExampleInput2">Origin</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="origin" placeholder="Pick up point" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Destination</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" name="destination" placeholder="Where to" >
            </div>

            <div class="form-group">
                <label for="formGroupExampleInput2">capacity_of_people</label>
                <input type="text" class="form-control" id="formGroupExampleInput2"  name="capacity_of_people" placeholder="No of people" >
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Identification</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Your ID No" name="identification" >
            </div>
            <button type="submit" name="driverForm" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
cd
</body>
</html>
