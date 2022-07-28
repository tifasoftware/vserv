<?php
    $servername = "db";
    $username   = "jesse";
    $password   = "password";
    $dbname     = "vdb";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection Failed: ". $conn->connect_error);
    }
?>
