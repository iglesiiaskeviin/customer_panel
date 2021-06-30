<?php
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, name, lastname, purchase_products FROM users WHERE id = :id');
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/07a1c5c4dc.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/styles/profile.css">
    <title>Profile - Customer panel</title>
</head>
<body>
    <?php if(!empty($user)): ?>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 mt-5 pt-5">
                    <div class="row z-depth-3">
                        <div class="col-sm-4 bg-info rounded-left">
                            <div class="card-block text-center text-white">
                                <div class="row">
                                    <i class="fas fa-user-circle fa-7x mt-5"></i>
                                    <span id="change-profile-photo" class="text-white mt-4">Change profile photo</span>
                                </div>
                                <h2 class="fw-bold mt-3">Your profile</h2>
                                <hr class="text-secondary">
                                <div class="p-2"><a href="logout.php" class="edit-user" href=""><i class="fas fa-sign-out-alt"></i> Logout</a></div>
                            </div>
                        </div>
                        <div class="col-sm-8 card-profile-info rounded-left">
                            <h3 class="mt-3 text-center">Information</h3>
                            <hr class="badge-primary mt-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="fw-bold">Email: </p>
                                    <h6 class="text-muted"><?= $user['email'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold">Name: </p>
                                    <h6 class="text-muted"><?= $user['name'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold">Lastname: </p>
                                    <h6 class="text-muted"><?= $user['lastname'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold">Products purchased: </p>
                                    <h6 class="text-muted"><?= $user['purchase_products'];?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
      <h1>Please Login or SignUp</h1>
      <a href="login.php">Login</a> or
      <a href="signup.php">SignUp</a>
    <?php endif; ?>
</body>
<script src="../js/show_modal.js"></script>
</html>