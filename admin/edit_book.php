<?php include '../db.php'; ?>
<?php
$id = $_GET['id'];
$book = $conn->query("SELECT * FROM books WHERE id=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Book</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
<h2>Edit Book</h2>
<form method="POST">
<input type="text" name="title" value="<?= $book['title'] ?>" required>
<input type="text" name="author" value="<?= $book['author'] ?>" required>
<input type="text" name="category" value="<?= $book['category'] ?>" required>
<select name="status">
  <option value="Available" <?= $book['status']=='Available'?'selected':'' ?>>Available</option>
  <option value="Issued" <?= $book['status']=='Issued'?'selected':'' ?>>Issued</option>
</select>
<button type="submit" name="update">Update</button>
</form>
</div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $status = $_POST['status'];
    $conn->query("UPDATE books SET title='$title', author='$author', category='$category', status='$status' WHERE id=$id");
    header("Location: dashboard.php");
}
?>
