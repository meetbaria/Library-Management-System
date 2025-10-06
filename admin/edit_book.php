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
<form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($book['category']) ?>" required><br><br>

    <label>Status:</label><br>
    <select name="status">
      <option value="available" <?= $book['status']=='available'?'selected':'' ?>>Available</option>
      <option value="issued" <?= $book['status']=='issued'?'selected':'' ?>>Issued</option>
    </select><br><br>

    <label>Current Cover:</label><br>
    <?php if ($book['cover']) { ?>
        <img src="../uploads/<?= $book['cover'] ?>" width="100"><br><br>
    <?php } else { echo "No cover uploaded<br><br>"; } ?>

    <label>Change Cover (optional):</label><br>
    <input type="file" name="cover" accept="image/*"><br><br>

    <button type="submit" name="update">Update Book</button>
</form>
</div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $cover = $book['cover']; // keep old one by default

    // If a new file uploaded
    if (!empty($_FILES['cover']['name'])) {
        $target_dir = "../uploads/";
        $new_cover = time() . '_' . basename($_FILES["cover"]["name"]);
        $target_file = $target_dir . $new_cover;

        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            // Delete old cover if exists
            if ($book['cover'] && file_exists("../uploads/" . $book['cover'])) {
                unlink("../uploads/" . $book['cover']);
            }
            $cover = $new_cover;
        }
    }

    $conn->query("UPDATE books 
                  SET title='$title', author='$author', category='$category', status='$status', cover='$cover' 
                  WHERE id=$id");

    header("Location: dashboard.php");
    exit;
}
?>
