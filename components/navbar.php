<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, name, lastname password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!-- <br> Welcome. <?= $user['name'] . $user['password'];?>
      <br>You are Successfully Logged In
      <a href="logout.php">
        Logout
      </a> -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap 4 Static Navbar</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<!-- BOOSTRAP & JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- FONT AWESOME -->
<script src="https://kit.fontawesome.com/07a1c5c4dc.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../assets/styles/navbar.css">
</head>
<body>
</body>
</html>