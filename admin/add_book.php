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
<form method="POST" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Category:</label><br>
    <input type="text" name="category"><br><br>

    <label>Cover Image:</label><br>
    <input type="file" name="cover" accept="image/*"><br><br>

    <button type="submit" name="add">Add Book</button>
</form>

</div>
</body>
</html>

<?php
include('../db.php'); // ensure DB connection

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $status = 'available';

    // Handle cover image upload
    $cover = null;
    if (!empty($_FILES['cover']['name'])) {
        $target_dir = "../uploads/";
        $cover = basename($_FILES["cover"]["name"]);
        $target_file = $target_dir . $cover;

        // Move uploaded file
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $target_file)) {
            // File uploaded successfully
        } else {
            echo "<script>alert('Error uploading cover image.');</script>";
        }
    }

    // Insert into database
    $conn->query("INSERT INTO books (title, author, category, status, cover) 
                  VALUES ('$title', '$author', '$category', '$status', '$cover')");

    header("Location: dashboard.php");
    exit;
}
?>

