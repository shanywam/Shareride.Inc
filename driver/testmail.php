<?php

//session_start();
include "../backend/db_config.php";

if(isset($_SESSION['user'])) {
    header('Location: testmail.php');
}

$db = new Database;

$conn = $db->dbConnect();

$reservation_id = $user_id = [];

$view_error  =  '';
$result = [];

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $reservation_id = (int)$_POST['book_id'];
    $user_id = (int)$_POST['user_id'];
    //$reservation_id = $_POST['resrvation_id'];
    //$user_id = $_POST['user_id'];

    $sql = "SELECT * FROM reservations (user_id, reservation_id) VALUES (" . $user_id . ", " . $reservation_id . ")";

    if (mysqli_query($conn, $sql)) {
        header("location: testmail.php");
    } else {
        $view_error = "Process was unsuccessful";
    }



    } elseif (isset($_POST["issue_action"])) 
    {
        $user_email = $_POST['email'];
        //issue book
        $to = $user_email;
        $subject = 'confirmation email ';
        $message = 'Hi, your ride for shareride.Inc has been confirmed';
        $headers = 'From: julietkiboi@gmail.com' . "\r\n" .
            'Reply-To: julietkiboi@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        if (mail($to, $subject, $message, $headers)) {
            echo 'Message could not be sent.';
        } else {
            echo 'Message has been sent';
        }
    }
function getUsers($user_id){
    global $conn;

    $sql="SELECT * FROM users WHERE id = $user_id";

    $dataStatus = mysqli_query($conn, $sql);
    $details = mysqli_fetch_array($dataStatus);

    return $details['first_name'] . ' ' . $details['last_name'];
}

function getRide($reservation_id) {
    global $conn;

    $sql="SELECT * FROM reservations WHERE id = $reservation_id";
    $dataStatus = mysqli_query($conn, $sql);
    $details = mysqli_fetch_array($dataStatus);

    return $details['origin'] . ' ' . $details['destination'];
}

$sql="SELECT * FROM rides"; 

$result=mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <link rel="stylesheet" href ="../css/bootstrap.min.css"/>
    <script src="../https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="../https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src ="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Shareride.Inc &#8211; Kenya&#039;s Taxi App &#8211; Based in Nairobi</title>
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
                <a class="nav-link" href="../driver/drive.php"><i style ="color:darkgrey ;"class="fa fa-home"></i> Home <span class="sr-only" >(current)</span></a>
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
    </div>

    <div id="ra_header_container_5ca64c7c3a2e8" class="modules-container ra_header_container_5ca64c7c3a2e8  vc_custom_1528890373974"></div>
    <script type="text/javascript">(function($) {$("head").append("<style>.rella-row-shadowbox-5ca64c7c34b20{-webkit-box-shadow:;-moz-box-shadow:;box-shadow:;}</style>");})(jQuery);</script>
</nav>
<p><?php echo $view_error ?></p>

<table class="table" style="width: 600px;background: #fcfcfc;margin: 70px auto;">
    <tr>
        <th> Name </th>
        <th> Ride </th>
        <th> Actions </th>
    </tr>

    <?php while($array=mysqli_fetch_array($result)) { ?>
    <tr>
        <td class="text-center"><?php echo getUsers($array['user_id']); ?></td>
        <td class="text-center"><?php echo getRide($array['reservation_id']); ?></td>


        <td>
        <form action="testmail.php" method="POST">
            <input type="hidden" name="ride_id" value="<?php echo $array[0]; ?>">

            <input type="hidden" value="issue_action" name="issue_action">

            <button type="submit" class="btn btn-secondary">Issue</button>
        </form>
                        </br>
        
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>