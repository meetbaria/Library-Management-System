<?php
include 'db.php';

$query = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';
$sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $statusClass = ($row['status'] === 'available') ? 'status-available' : 'status-issued';
    echo "
      <div class='book-card'>
        <img src='images/{$row['cover']}' alt='{$row['title']}'>
        <h3>{$row['title']}</h3>
        <p>by {$row['author']}</p>
        <span class='$statusClass'>{$row['status']}</span>
        <button onclick=\"requestBook('{$row['title']}')\">Request</button>
      </div>
    ";
  }
} else {
  echo "<p style='text-align:center;color:#555;'>No books found.</p>";
}
?>
