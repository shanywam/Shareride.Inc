<?php
session_start();

require_once('../backend/db_config.php');

//$reg_user = new User();

/*if ($reg_user->is_logged_in()) {
    if ($_SESSION['user_type'] == 1) {
        $reg_user->redirect('../driver/drive.php');
    } else {
        $reg_user->redirect('../client/ride.php');
    }
}*/

$form_error  = $delete_error = $date = $success_message = '';
$show_form  = false;
$id = $name  = $phone = $origin = $destination = $capacity_of_vehicle = $user_id = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    var_dump($_POST);
    // Validate Form
    if (isset($_POST['create_new'])) { // creating new

        if (
            empty(trim($_POST["name"]))
            && empty(trim($_POST["phone"]))
            && empty(trim($_POST["origin"]))
            && empty(trim($_POST["destination"]))
            && empty(trim($_POST["capacity_of_vehicle"]))

        ) {
            $form_error = " Fill form.";
            echo 'please fill';
        }
        // Validate name
        if (strlen(trim($_POST["name"])) < 3) {
            $name_err = "name must have at least 6 characters.";
        }
        // Validate Password
        if (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }
    }else {
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $origin = $_POST["origin"];
        $destination = $_POST["destination"];
        $capacity_of_vehicle = $_POST["capacity_of_vehicle"];

        $sql = "INSERT into rides(name, phone, origin, destination, capacity_of_vehicle) VALUES ('$name', '$phone', '$origin', '$destination', '$capacity_of_vehicle')";

        // echo (mysqli_query($conn,$sql));

        $enter = mysqli_query($conn, $sql);

        var_dump($enter);
    }

} elseif (isset($_POST['create_edit'])) {

    $ride_id = $_POST["ride_id"];

    // echo $books_id;

    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $capacity_of_vehicle = $_POST["capacity_of_vehicle"];

    $sql = "UPDATE rides SET name = '$name', phone = '$phone', origin = '$origin', destination = '$destination', capacity_of_vehicle = '$capacity_of_vehicle'  WHERE id='$ride_id'";

    $edit = mysqli_query($conn, $sql);

} elseif (isset($_POST["delete_action"])) {

    $ride_id = $_POST["ride_id"];

    $sql = "DELETE from rides WHERE id='$ride_id'";

    if (mysqli_query($conn, $sql)) {
        header("location: rides.php");
    } else {
        $delete_error = "Deletion process was unsuccessful";
    }

} elseif (isset($_POST['edit_action'])) {

    $ride_id = $_POST["ride_id"];

    $sql = "SELECT * FROM rides WHERE id = '$ride_id'";

    $data = mysqli_query($conn, $sql);

    $details = mysqli_fetch_row($data);

    $name = $details[1];
    $phone = $details[2];
    $origin = $details[3];
    $destination = $details[4];
    $capacity_of_vehicle = $details[5];
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
        <p><?php echo $form_error ?></p>
        <p><?php echo $delete_error?></p>
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
            <form action="../ride.php" method="post">
                <input type="hidden" name="rides_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" value="delete_action" name="delete_action">

                <button type="submit" class="btn btn-primary">Delete</button>
                <!--            </form>-->
                <!--            </br>-->
                <!---->
                <!--            <form action="ride.php" method="post">-->

                <input type="hidden" name="ride_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" name="edit_action" value="edit_action">

                <button type="submit" class="btn btn-primary">Edit</button>

            </form>
        </td>
        <?php } ?>
</body>
</html>