<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
      header('Location: user-logged.php');
    }
    require 'db.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
      $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
      $records->bindParam(':email', $_POST['email']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

      $message = '';

      if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: user-logged.php");
      } else {
        $message = '<label class="text-danger">Sorry, those credentials do not match</label>';
      }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/styles/signup.css">
    <link rel="stylesheet" href="../assets/styles/font.css">
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/07a1c5c4dc.js" crossorigin="anonymous"></script>
    <title>Login - Customer Panel</title>
  </head>
  <body>
    <section class="form section-login">
      <div class="contaniner">
        <div class="row">
          <div class="col-lg-5 m-auto text-center p-2 company-logo-container">
          <span class="display-4">Customer Panel</span>
            <img src="../assets/img/DevKevLogoStore.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-7 px-5 pt-5">
            <h1 class="fw-bold">Login</h1>
            <span class="display-6 py-3">Sign into your account</span>
            <?php if(!empty($message)) : ?>
                <p><?= $message;?></p>
            <?php endif;?>
            <form action="login.php" method="post">
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="text" name="email" class="form-control my-3 p-4" placeholder="Email Address">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="password" name="password" class="form-control my-3 p-4" placeholder="****">
                </div>
              </div>
              <div class="form-row">
              <div class="col-lg-7">
                <input type="submit" class="btn1 mt-3" value="Login!">
              </div>
            </div>
            </form>
            <div class="row my-2 mb-3 account-access-container fw-bold">
              <p>¿Don´t registered?</p>
              <span><a href="signup.php"><i class="fas fa-arrow-right"></i> Create a account</a></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>