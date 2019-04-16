<?php
session_start();

require_once('../backend/auth.php');

$reg_user = new User();

/*if ($reg_user->is_logged_in()) {
    if ($_SESSION['user_type'] == 1) {
        $reg_user->redirect('../driver/drive.php');
    } else {
        $reg_user->redirect('../client/ride.php');
    }
}*/

$form_error  = $delete_error = $date = $success_message = '';
$show_form  = false;
$id = $user_id = $identification_no =  "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Form
    if (isset($_POST['create_new'])) { // creating new

        if (
            empty(trim($_POST["user_id"]))
            && empty(trim($_POST["identification_no"]))


        ) {
            $form_error = " Fill form.";
        }

    }else {
        $name = $_POST["user_id"];
        $identification_no = $_POST["identification_no"];


        $sql = "INSERT INTO driver(user_id, identification_no) VALUES ('$user_id', '$identification_no')";

        // echo (mysqli_query($conn,$sql));

        $enter = mysqli_query($conn, $sql);
    }

} elseif (isset($_POST['create_edit'])) {

    $driver_id = $_POST["driver_id"];

    // echo $ id;

    $name = $_POST["user_id"];
    $identification_no = $_POST["identification_no"];

    $sql = "UPDATE driver SET user-id = '$user_id', identification_no = '$identification_no'  WHERE id='$driver_id'";

    $edit = mysqli_query($conn, $sql);

} elseif (isset($_POST["delete_action"])) {

    $driver_id = $_POST["driver_id"];

    $sql = "DELETE from driver WHERE id='$driver_id'";

    if (mysqli_query($conn, $sql)) {
        header("location: driverform.php");
    } else {
        $delete_error = "Deletion process was unsuccessful";
    }

} elseif (isset($_POST['edit_action'])) {

    $driver_id = $_POST["driver_id"];

    $sql = "SELECT * FROM driver WHERE id = '$driver_id'";

    $data = mysqli_query($conn, $sql);

    $details = mysqli_fetch_row($data);

    $user_id = $details[1];
    $identification_no = $details[2];

$sql="select * from driver";

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


<div class="container">
    <div class="wrapper">
        <h3 class="text-center">Welcome to Shareride.Inc</h3>

        <p class="text-center">Fill form .</p>

        <p class="text-center help-block" style="color: red;"></p>

        <?php
        //echo $form_error
        ?>

        <form style="width: 400px;background: #fcfcfc;margin: 70px auto;">
            <div class="form-group" >
                <label for="formGroupExampleInput">user_id</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">identification_no</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone no">
            </div>

            <?php if(empty($id)){ ?>

                <input type="hidden" value="create_new" name="create_new">
            <?php }else { ?>
                <input type="hidden" value="create_new" name="create_edit">

                <input type="hidden" value="<?php echo $driver_id; ?>" name="ride_id"/>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<table class="container">

    <tr>
        <th> User_id </th>
        <th> Identification_id </th>
        <th> Action </th>

    </tr>

    <?php
    while($array=mysqli_fetch_row($result)){ ?>
    <tr>
        <td class="text-center"><?php echo $array[1]; ?></td>
        <td class="text-center"><?php echo $array[2]; ?></td>



        <td>
            <form action="./driveform.php" method="post">
                <input type="hidden" name="driver_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" value="delete_action" name="delete_action">

                <button type="submit" class="btn btn-primary">Delete</button>
                <!--            </form>-->
                <!--            </br>-->
                <!---->
                <!--            <form action="books.php" method="post">-->

                <input type="hidden" name="driver_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" name="edit_action" value="edit_action">

                <button type="submit" class="btn btn-primary">Edit</button>

            </form>
        </td>
        <?php } ?>
    <?php } ?>
</body>
</html>