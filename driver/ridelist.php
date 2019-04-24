<?php
session_start();

require_once('../backend/db_config.php');

$data = new DbConfig();
$conn = $data->connect();

$view_error  = $delete_error = $success_message = '';


if (isset($_POST["deleteRide"])) {

    $ride_id = $_POST["ride_id"];

    $sql = "DELETE from rides WHERE id='$ride_id'";

    if (mysqli_query($conn, $sql)) {

    } else {
        $delete_error = "Deletion process was unsuccessful";
    }

}

$sql="select * from rides";

$result=mysqli_query($conn,$sql);
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

        <p><?php echo $delete_error?></p>
        <p><?php echo $view_error?></p>
        <p><?php echo $success_message; ?></p>




<table class="container">

    <tr>
        <th> Name </th>
        <th> Phone </th>
        <th> Origin </th>
        <th> Destination </th>
        <th> Capacity_of_vehicle </th>
        <th> Action </th>

    </tr>

    <?php
    while($array=mysqli_fetch_row($result)){ ?>
    <tr>
        <td class="text-center"><?php echo $array[1]; ?></td>
        <td class="text-center"><?php echo $array[2]; ?></td>
        <td class="text-center"><?php echo $array[3]; ?></td>
        <td class="text-center"><?php echo $array[4]; ?></td>
        <td class="text-center"><?php echo $array[5]; ?></td>


        <td>
            <form method="post">
                <input type="hidden" name="ride_id" value="<?php echo $array[0]; ?>">

                <button type="submit" name="deleteRide" class="btn btn-primary">Delete</button>

            </form>
        </td>
        <?php } ?>
</body>
</html>