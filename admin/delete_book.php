<?php
include '../db.php';
$id = $_GET['id'];

// Get cover image before deleting
$result = $conn->query("SELECT cover FROM books WHERE id=$id");
$book = $result->fetch_assoc();

if ($book && $book['cover'] && file_exists("../uploads/" . $book['cover'])) {
    unlink("../uploads/" . $book['cover']); // delete the image file
}

$conn->query("DELETE FROM books WHERE id=$id");
header("Location: dashboard.php");
exit;
?>
