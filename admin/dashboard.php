<?php include '../db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
<h1>Manage Books</h1>
<a href="add_book.php" class="btn">Add Book</a>
<table>
<tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th><th>Status</th><th>Action</th></tr>

<?php
$result = $conn->query("SELECT * FROM books");
while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['title']}</td>
        <td>{$row['author']}</td>
        <td>{$row['category']}</td>
        <td>{$row['status']}</td>
        <td>
            <a href='edit_book.php?id={$row['id']}'>Edit</a> |
            <a href='delete_book.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>";
}
?>
</table>
</div>
</body>
</html>
