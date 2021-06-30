<?php
  require 'db.php';
  if (!empty($_POST["email"])) {
    $sql_query = 'INSERT INTO users (email, password, name, lastname) VALUES (:email, :password, :name, :lastname)';
    $stmt = $conn->prepare($sql_query);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':lastname', $_POST['lastname']);
    if ($stmt->execute()) {
      header("Location: login.php");
      die();
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
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <h1 class="fw-bold">Register</h1>
            <span class="display-6 py-3">Please, fill all the inputs</span>
                  
            <form action="signup.php" method="post">
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="text" name="name" class="form-control my-3 p-4" placeholder="Name">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="text" name="lastname" class="form-control my-3 p-4" placeholder="Lastname">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="email" name="email" class="form-control my-3 p-4" placeholder="Email Address">
                </div>
              </div>
              <div class="form-row">
                <div class="col-lg-7">
                  <input type="password" name="password" class="form-control my-3 p-4" placeholder="*****">
                </div>
              </div>
              <div class="form-row">
              <div class="col-lg-7">
                <input type="submit" class="btn1 mt-3 mb-5" value="Sign up!">
              </div>
            </div>
            </form>
            <div class="row my-2 mb-3 account-access-container">
              <p>¿Have a account?</p>
              <span><a href="login.php">Login here</a></span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>