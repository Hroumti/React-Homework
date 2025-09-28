<?php
    $conn = mysqli_connect("localhost", "root", "", "db1");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>