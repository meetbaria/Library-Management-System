<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📚 Smart Library Portal</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- 🧭 Navbar -->
  <header class="navbar">
    <h1>📚 Smart Library Portal</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="#">My Requests</a>
      <a href="#">Contact</a>
    </nav>
  </header>

  <!-- 🔍 Search -->
  <section class="search-section">
    <h2>Find Your Next Book</h2>
    <input type="text" id="searchInput" placeholder="Search books..." onkeyup="searchBooks()">
  </section>

  <!-- 🏆 Trending Books -->
  <section class="books-section">
    <h2>🔥 Trending & Available Books</h2>
    <div class="books-container" id="booksContainer">
      <?php
      $query = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
      while ($row = mysqli_fetch_assoc($query)) {
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
      ?>
    </div>
  </section>

  <script>
  // 🔍 Live search using AJAX
  function searchBooks() {
    const query = document.getElementById('searchInput').value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      document.getElementById("booksContainer").innerHTML = this.responseText;
    }
    xhr.send("query=" + query);
  }

  // 📘 Request a book
  function requestBook(title) {
    fetch('request.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'book=' + encodeURIComponent(title)
    })
    .then(res => res.text())
    .then(alert);
  }
  </script>
</body>
</html>
