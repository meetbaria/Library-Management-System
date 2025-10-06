<?php
include('../db.php');

// Fetch all books
$books = $conn->query("SELECT * FROM books ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard | Library Management</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      background: linear-gradient(120deg, #f6f9fc, #dbeafe);
      font-family: "Segoe UI", sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #4a6cf7;
      color: white;
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    header h1 {
      margin: 0;
      font-size: 22px;
      letter-spacing: 0.5px;
    }

    .nav-buttons a {
      text-decoration: none;
      color: white;
      background: rgba(255,255,255,0.2);
      padding: 8px 14px;
      border-radius: 6px;
      margin-left: 10px;
      transition: 0.3s;
    }

    .nav-buttons a:hover {
      background: white;
      color: #4a6cf7;
    }

    .container {
      max-width: 1000px;
      margin: 40px auto;
      background: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
      font-size: 24px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 15px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #4a6cf7;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #e0e7ff;
    }

    .action-btn {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 6px;
      text-decoration: none;
      color: white;
      font-size: 13px;
    }

    .edit {
      background-color: #10b981;
    }

    .delete {
      background-color: #ef4444;
    }

    .add-btn {
      display: inline-block;
      background-color: #4a6cf7;
      color: white;
      padding: 10px 16px;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
      transition: 0.3s;
      margin-bottom: 15px;
    }

    .add-btn:hover {
      background-color: #1e40af;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      padding: 15px;
      color: #666;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Library Admin Dashboard</h1>
    <div class="nav-buttons">
      <a href="add_book.php">Add Book</a>
      <a href="../index.php">Student View</a>
    </div>
  </header>

  <div class="container">
    <h2>Manage Books</h2>
    <a href="add_book.php" class="add-btn">+ Add New Book</a>

    <table>
      <tr>
        <th>ID</th>
        <th>Book Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>

      <?php while ($row = $books->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= htmlspecialchars($row['author']) ?></td>
          <td><?= htmlspecialchars($row['category']) ?></td>
          <td style="color:<?= $row['status'] == 'available' ? '#10b981' : '#ef4444' ?>;">
            <?= ucfirst($row['status']) ?>
          </td>
          <td>
            <a href="edit_book.php?id=<?= $row['id'] ?>" class="action-btn edit">Edit</a>
            <a href="delete_book.php?id=<?= $row['id'] ?>" class="action-btn delete"
               onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>

  <footer>
    &copy; <?= date('Y') ?> Library Management System | Designed by Admin
  </footer>
</body>
</html>
