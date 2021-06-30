<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, name, lastname FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Index - Customer Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- BOOSTRAP & JQUERY -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/07a1c5c4dc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/styles/navbar.css">
  </head>
  <body>

    <?php if(!empty($user)): ?>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
        <img src="../assets/img/DevKevLogoStore.png" class="img-fluid navbar-co-img"  alt="">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link">Products</a>
            <a href="#" class="nav-item nav-link">About us</a>
        </div>
        <div class="navbar-nav user-navbar-logged text-center">
            <a href="profile.php" class="mx-3"><i class="fas fa-user p-3"></i><?= $user['name'] .' '. $user['lastname'];?></a>
        </div>
    </div>
</nav>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>

      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
  </body>
</html>