<?php
    $conn = mysqli_connect("localhost", "root", "", "efmcasa");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>