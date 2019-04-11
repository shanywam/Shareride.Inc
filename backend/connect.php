<?php

//error reporting at level 0 is to prevent the browser from outputing such a descriptive error

error_reporting(0);
$host = '127.0.0.1';
$username = 'homestead';
$password = 'secret';
$database = 'shareride';
$port= '3306';


//would have given the parameter as the name of the database if only I'd created it
$con = mysqli_connect("127.0.0.1", "homestead", "secret", "shareride", "3306");

//check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to mysqli:" . mysqli_connect_error();


}
//else{
//echo "connected";
//}
?>