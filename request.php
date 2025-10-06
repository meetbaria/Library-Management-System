<?php
include 'db.php';

if (isset($_POST['book'])) {
  $book = mysqli_real_escape_string($conn, $_POST['book']);
  echo "✅ Your request for '$book' has been submitted successfully!";
} else {
  echo "❌ No book selected.";
}
?>
