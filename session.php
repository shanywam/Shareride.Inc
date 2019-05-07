<?php
session_start();
require_once "backend/db_config.php";

$email = $_SESSION['user'];

$results = $conn->query( "SELECT * FROM users WHERE email = $email");
while ($row = $results->fetch_object()) {


    $userName = $row->full_name;
    $userEmail = $row->email;
    $userRole = $row->user_type;

}

$conn->close();

