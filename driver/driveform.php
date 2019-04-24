<?php
session_start();

require_once('../backend/db_config.php');


$form_error  = $delete_error = $date = $success_message = '';
$show_form  = false;
$id = $user_id  = $firstname = $lastname = $email= $identification_no = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Form
    if (isset($_POST['create_new'])) { // creating new

        if (
            empty(trim($_POST["firstname"]))
            && empty(trim($_POST["lastname"]))
            && empty(trim($_POST["email"]))
            && empty(trim($_POST["identification_no"]))

        ) {
            $form_error = " Fill form.";
            echo 'please fill form';

        } else {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $identification_no = $_POST["identification_no"];

            $sql = "INSERT INTO driver(firstname, lastname, email, identification_no) VALUES ('$firstname', '$lastname', '$email', '$identification_no')";

            $enter = mysqli_query($conn, $sql);

            //var_dump($conn, $sql, $enter);
        }

    } elseif (isset($_POST['create_edit'])) {
        $driver_id = $_POST["driver_id"];
        
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $identification_no = $_POST["identification_no"];

        $sql = "UPDATE driver SET firstname = '$firstname', lastname = '$lastname', email = '$email', identification_no = '$identification_no'  WHERE id='$driver_id'";

        $edit = mysqli_query($conn, $sql);

    } elseif (isset($_POST["delete_action"])) {

        $driver_id = $_POST["driver_id"];
var_dump($_POST);
        $sql = "DELETE from driver WHERE id='$driver_id'";

        if (mysqli_query($conn, $sql)) {
            header("location: driveform.php");
        } else {
            $delete_error = "Deletion process was unsuccessful";
        }

    } elseif (isset($_POST['edit_action'])) {

        $driver_id = $_POST["driver_id"];
var_dump($_POST);
        $sql = "SELECT * FROM driver WHERE id = '$driver_id'";

        $data = mysqli_query($conn, $sql);

        $details = mysqli_fetch_row($data);

        $firstname = $details[2];
        $lastname = $details[3];
        $email = $details[4];
        $identification_no= $details[5];

    }
}
$sql="SELECT * FROM driver";

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

        <form action= "driveform.php" style="width: 400px;background: #fcfcfc;margin: 70px auto;" method="POST">
            <div class="form-group" >
                <label for="formGroupExampleInput">Firstname</label>
                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Firstname" name="firstname" value="<?php echo $firstname ; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Lastname</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Lastname" name="lastname" value="<?php echo $lastname ; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Email</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Your Email" name="email" value="<?php echo $email ; ?>">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Identification_no</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Your ID No" name="identification_no" value="<?php echo $identification_no ; ?>" >
            </div>
            <?php if(empty($driver_id)){ ?>

                <input type="hidden" value="create_new" name="create_new">
            <?php }else { ?>
                <input type="hidden" value="create_edit" name="create_edit">

                <input type="hidden" value="<?php echo $driver_id; ?>" name="driver_id"/>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<table class="container">

    <tr>
        <th> Firstname </th>
        <th> Lastname </th>
        <th> Email </th>
        <th> Identification_no </th>
        <th> Action </th>

    </tr>

    <?php while ($array=mysqli_fetch_row($result)){ ?>
    <tr>
        <td class="text-center"><?php echo $array[2]; ?></td>
        <td class="text-center"><?php echo $array[3]; ?></td>
        <td class="text-center"><?php echo $array[4]; ?></td>
        <td class="text-center"><?php echo $array[5]; ?></td>



        <td>
            <form action="driveform.php" method="POST">
                <input type="hidden" name="driver_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" value="delete_action" name="delete_action">

                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                           <br>

                          <form action="driveform.php" method="post">

                <input type="hidden" name="driver_id" value="<?php echo $array[0]; ?>">

                <input type="hidden" name="edit_action" value="edit_action">

                <button type="submit" class="btn btn-primary">Edit</button>

            </form>
        </td>
        <?php } ?>
</body>
</html>