<?php
    session_start();
   
    require "db.php";

    $sql = "DELETE FROM users WHERE username='".$_SESSION['username']."'";

    if ($_SESSION['username'] == "root")
    {
        echo "Cannot Delete Protected User!";
        echo "<br><a href='index.php'>Return</a>";
    } else {
        if ($conn->query($sql) === TRUE) {
            header("Location: logout.php");
        } else {
            echo "Error deleting user: " . $conn->error;
            echo "<br><a href='index.php'>Return</a>";

        }
    }
?>