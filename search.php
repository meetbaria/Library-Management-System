<?php
include 'db.php';

$q = $_GET['q'] ?? '';

$sql = "SELECT * FROM books WHERE title LIKE '%$q%' OR author LIKE '%$q%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Title</th><th>Author</th><th>Category</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['category']}</td>
                <td>{$row['status']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No books found</p>";
}
?>
