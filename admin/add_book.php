<?php include '../db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Add Book</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
<h2>Add Book</h2>
<form method="POST">
<input type="text" name="title" placeholder="Book Title" required>
<input type="text" name="author" placeholder="Author" required>
<input type="text" name="category" placeholder="Category" required>
<button type="submit" name="add">Add Book</button>
</form>
</div>
</body>
</html>

<?php
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $conn->query("INSERT INTO books (title, author, category) VALUES ('$title','$author','$category')");
    header("Location: dashboard.php");
}
?>
