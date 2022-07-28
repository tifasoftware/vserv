<?php
    session_start();
   
    require "db.php";

    $sql = "DELETE FROM records WHERE recordname='".$_SESSION['lastrec']."'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
     } else {
         echo "Error deleting record: " . $conn->error;
        echo "<a href='index.php'>Return</a>";

     }
?>