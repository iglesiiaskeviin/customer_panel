<?php
    $error = '';
  session_start();

  require 'db.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
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
    <link rel="stylesheet" href="../assets/styles/font.css">
    <title>Profile - Customer panel</title>
</head>
<body>
    <?php if(!empty($user)): ?>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 mt-5 pt-5">
                    <div class="row z-depth-3">
                        <div class="col-sm-4 rounded-left profile-section">
                            <div class="card-block text-center text-white">
                                <div class="col">
                                <input type="button" class="btn btn-danger text-center mt-3 w-50 m-auto" value="New profile photo" id="change-profile-photo">
                                    <?php
                                        if ($user['avatar'] !== null or $user['avatar'] === '') {
                                            $profile_url = 'user_avatars/';
                                           $profile_avatar = $user['avatar'];
                                        }else{
                                            $profile_url = '../assets/img/';
                                            $profile_avatar = 'no_avatar.png';
                                        }
                                    ?>
                                    <img src=<?=$profile_url.$profile_avatar?> class="rounded w-50 h-50 mt-4" alt="">
                                    <?php echo $error; ?>
                                </div>
                                <div class="col m-auto text-center mt-5 d-none" id="img-input-selector" >
                                    <form action="upload.php" method="post" enctype='multipart/form-data'>
                                        <input type="file" name="profileImage" id="profileImage">
                                        <input class="mt-2 btn1 bg-danger" type="submit" name="submit" value="Update new photo">
                                    </form>
                                </div>

                                <div class="mt-4 mb-4"><a href="logout.php" class="edit-user" href=""><i class="fas fa-sign-out-alt"></i> Logout</a></div>
                                <div class="mt-4 mb-4"><a href="user-logged.php" class="edit-user" href=""><i class="fas fa-sign-out-alt"></i> Index</a></div>
                            </div>
                        </div>
                        <div class="col-sm-8 card-profile-info rounded-left">
                            <h3 class="mt-3 text-center">Profile Information</h3>
                            <hr class="badge-primary mt-4 mb-4">
                            <div class="row text-center">
                                <div class="col-sm-6">
                                    <p class="fw-bold fs-5">Email: </p>
                                    <h6 class="text-muted"><?= $user['email'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold fs-5">Name: </p>
                                    <h6 class="text-muted"><?= $user['name'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold fs-5">Lastname: </p>
                                    <h6 class="text-muted"><?= $user['lastname'];?></h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-bold fs-5">Products publicated: </p>
                                    <h6 class="text-muted"><?= $user['publicated_products'];?></h6>
                                </div>
                                <?php if ($user['type'] === 'customer'): ?>
                                    <div class="col-sm-6 text-center m-auto">
                                        <input class="btn btn-danger" type="button" value="Publicate new product">
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: require 'login.php'; ?>
    <?php endif; ?>
</body>
<script>
    $("#change-profile-photo").click(function(){
        let is_hidden = $("#img-input-selector").is(":hidden");
        if (is_hidden === true) {
        $("#img-input-selector").removeClass("d-none");
        }else if(is_hidden === false){
        $("#img-input-selector").addClass("d-none");
        }
    });
</script>
</html>