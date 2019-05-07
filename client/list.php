<?php

// session_start();

include  "../backend/db_config.php";

if (isset($_SESSION['user'])) {

    header('Location: list.php');
}

$_SESSION['user_type'] = 2;

$form_error = $delete_error = $date = $success_message = '';

$db = new Database();

$conn = $db->dbConnect();


$show_form = false;
$id = $origin = $destination = $vehicle_capacity = $identification  = "";
$result = [];
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM reservations";

    $result = mysqli_query($conn, $sql);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["delete_action"])) {

        $reservation_id = $_POST["book_id"];

        $sql = "DELETE from reservations WHERE id='$reservation_id'";

        if (mysqli_query($conn, $sql)) {
            header("location: list.php");
        } else {
            $delete_error = "Deletion process was unsuccessful";
        }

    } elseif (isset($_POST['edit_action'])) {

        header('Location: rideform.php');

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
<p><?php echo $form_error ?></p>
<p><?php echo $delete_error ?></p>
<p><?php echo $success_message; ?></p>


<?php foreach ($result as $list) { ?>

    <div class="col-sm-4" style="margin-bottom: 30px; 4px;float: left">

        <div class="card"style=" background-color: #0c5460" >

            <p class="card-body" style="padding-top:">

        

                <h5 class="card-title"><strong><?php echo $list['origin']; ?></strong></h5>

                <h5 class="card-title"><strong><?php echo $list['destination']; ?></strong></h5>

                <p class="card-text"><small><strong>No of people: </strong><?php echo $list['vehicle_capacity']; ?></small></p>

                <h5 class="card-title"><strong><?php echo $list['identification']; ?></strong></h5>

            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 1) { ?>

                    <form action="list.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $list['id']; ?>">

                        <input type="hidden" value="delete_action" name="delete_action">

                        <button type="submit" class="btn btn-danger">Delete</button><br>
                    </form>
                    <br><br>
            <?php } if ($_SESSION["user_type"] == 2 ) { ?>
                    <form action="rideform.php" method="POST">

                        <input type="hidden" name="book_id" value="<?php echo $list['id']; ?>">

                        <input type="hidden" name="edit_action" value="edit_action">

                        <button type="submit" class="btn btn-primary">Edit</button>

                    </form>

            <?php } ?>
            </p>
            </div>
        </div>
    </div>


<?php } ?>
        

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>