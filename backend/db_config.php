
<?php
define('DB_SERVER', '127.0.0.1');

define('DB_USERNAME', 'shareride');

define('DB_PASSWORD', 'secret');

define('DB_DATABASE', 'shareride');

define('DB_PORT', '3306');


    $conn = mysqli_connect("127.0.0.1", "shareride", "secret", "shareride", "3306");

    //check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to mysqli:" . mysqli_connect_error();


    }else{
    echo "connected";

}

?>