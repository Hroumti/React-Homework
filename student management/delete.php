<?php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Prepare the delete query
$query = "DELETE FROM students2 WHERE id = ?";

// Use a prepared statement to prevent SQL injection
mysqli_prepare($conn, $query);
header('Location: index.php');
?>
