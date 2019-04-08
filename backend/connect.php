<?php

//error reporting at level 0 is to prevent the browser from outputing such a descriptive error yenye itafanya site yako isikue secure

error_reporting(0);
$host = 'localhost';
$username = 'trusty';
$password = 'root';
$database = 'shareride';

//using mysqli drive
$db = new mysqli($host, $username, $password, $database);

//would have given the parameter as the name of the database if only I'd created it

if($db->connect(localhost, trusty, root, shareride)) {

    echo "success";

} else {

    die("Wrong Credentials");

}

?>