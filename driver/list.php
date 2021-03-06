<?php

// session_start();

include  "../backend/db_config.php";

if (isset($_SESSION['user'])) {

    header('Location: list.php');
}
$_SESSION['user_type'] = 1;

$form_error = $delete_error = $date = $success_message = '';

$db = new Database;
$conn = $db->dbConnect();


$show_form = $giveRide =false;
$id = $origin = $destination = $vehicle_capacity = $identification  = "";
$reservation_id = $user_id = [];

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

function checkRideGiven($reservation_id)
{
    global $conn;

    $sql = "SELECT * FROM rides WHERE reservation_id = $reservation_id";

    $res = mysqli_query($conn, $sql);

    $details = mysqli_fetch_array($res);

    if ($details) {
        return false;
    }

    return true;
}

$sql = "SELECT * FROM reservations";

$result =mysqli_query($conn, $sql);


if(isset($_POST['giveRide'])) {

    $reservation_id = $_POST['book_id'];
    //$user_id = $_SESSION[ 4 ];
    $user_id = 3 ;
    $identification = $_POST['identification'];


    $sqlGiveRide = "INSERT into rides (user_id, reservation_id) VALUES ($user_id, $reservation_id)";

    $enter = mysqli_query($conn, $sqlGiveRide);

    if ($enter) {
        $success_message = "Ride has been allocated";
    } else {
        $form_error = 'Process was unsuccessful';
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

    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Dosis|PT+Sans+Narrow" rel="stylesheet">

    <script type="text/javascript"> $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })</script>

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
                    <a class="nav-link" href="../driver/drive.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../driver/list.php"><i style ="color:darkgrey ;"class="fa fa-list"></i>List <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="../driver/testmail.php"><i style ="color:darkgrey ;"class="fa fa-star-of-david"></i> Status <span class="sr-only">(current)</span></a>
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

        

                <h5 class="card-title"  ><strong style="font-weight: 500;font-family: 'Dosis', sans-serif;><?php echo $list['origin']; ?></strong></h5>

                <h5 class="card-title" ><strong ><?php echo $list['destination']; ?></strong></h5>

                <p class="card-text" ><small><strong>No of people: </strong><?php echo $list['vehicle_capacity']; ?></small></p>

                <h5 class="card-title"><strong><?php echo $list['identification']; ?></strong></h5>

            <?php if ($_SESSION["user_type"] == 2 || $_SESSION["user_type"] == 1) { ?>

                    <form action="list.php" method="POST">
                        <input type="hidden" name="book_id" value="<?php echo $list['id']; ?>">

                        <input type="hidden" value="delete_action" name="delete_action">

                        <button type="submit" class="btn btn-danger">Delete</button><br>
                        <!-- Button trigger modal -->
                        <!-- <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                          Delete
                        </button>

                        // Modal 
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                You Have Deleted the Request
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div> -->
                    </form>
                    <br><br>
            <?php } if ($_SESSION["user_type"] == 1 ) { ?>
                <?php }if (checkRideGiven($list['id'])) { ?>
                    <p>
                    <form action="list.php" method="POST">

                        <input type="hidden" name="book_id" value="<?php echo $list['id']; ?>">

                        <input type="hidden" name="identification" value="<?php echo $list['identification']; ?>">

                        <button type="submit" name="giveRide" class="btn btn-secondary">Give ride</button>

                    </form>
                </p>
            <?php } else { ?>
                <p style="font-weight: 500;font-family: 'Dancing Script', cursive; color: white"> Ride Given </p>
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