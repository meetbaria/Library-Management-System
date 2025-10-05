<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Library Book Search</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h1>Library Book Search</h1>
    <input type="text" id="search" placeholder="Search by title or author...">
    <div id="result"></div>
</div>

<script>
document.getElementById('search').addEventListener('keyup', function() {
    const query = this.value;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "search.php?q=" + query, true);
    xhr.onload = function() {
        document.getElementById('result').innerHTML = this.responseText;
    };
    xhr.send();
});
</script>
</body>
</html>
