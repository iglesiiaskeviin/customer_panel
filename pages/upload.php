<?php
    session_start();
    require 'db.php';

    $error_msg = '';
    if (is_uploaded_file($_FILES['profileImage']['tmp_name'])) {
        $img_name = $_FILES['profileImage']['name'];
        $img_size = $_FILES['profileImage']['size'];
        $tmp_name = $_FILES['profileImage']['tmp_name'];
        $error = $_FILES['profileImage']['error'];

        if ($error === 0) {
            if ($img_size > 12500000) {
                $error_msg = 'The image is too large';
                header('Location: profile.php?error=$error_msg');
            }else{
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_types = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_types)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_path_folder = 'user_avatars/'.$new_img_name;
                    
                    move_uploaded_file($tmp_name, $img_path_folder);

                    $sql_query = ('UPDATE users SET avatar = :avatar WHERE id = :id');
                    
                    $stmt = $conn->prepare($sql_query);

                    $stmt->bindParam(':avatar', $new_img_name);
                    $stmt->bindParam(':id', $_SESSION['user_id']);

                    if ($stmt->execute()) {
                        $error_msg = 'Profile photo updated!';
                        header('Location: profile.php?error=$error_msg');
                    }
        

                }else{
                    $error_msg = 'Image format not valid[JPG, JPEG, PNG]';
                    header('Location: profile.php?error=$error_msg');
                }

            }
        }else{

        }

    }else{
        $error_msg = 'Please, select a file!';
        header('Location: profile.php?error=$error_msg');
    }

?>