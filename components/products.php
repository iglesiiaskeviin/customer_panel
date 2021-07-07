<?php 
    $icon_to_put = '';
    require '../pages/db.php';
    $query = 'SELECT * FROM products';
    $res = $conn->prepare($query);
    $res->execute();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Lista de productos - Customer Panel</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/styles/font.css">
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/07a1c5c4dc.js" crossorigin="anonymous"></script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<?php require 'navbar.php'; ?>
<div class="container">
    <?php
    while( $record = $res->fetch(PDO::FETCH_ASSOC) ) {
        if ($record['img'] === 'none') {
            $img_url = '../assets/img/';
            $img = 'no_product_img.png';
        }else{
            $img_url = '../pages/product_images/';
            $img = $record['img'];
        }
        if ($record['type'] === 'script') {
            $product_type = 'Script/Plugin';
        }else if($record['type'] === 'map'){
            $product_type = 'Mapeo/Mejora';
        }

        /* getting the seller ID information */
        $seller = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $seller->bindParam(':id', $record['clientID']);
        $seller->execute();
        $sell_pdo = $seller->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="card p-5 my-5 bg-white">
        <div class="text-center m-auto p-2 mb-2 fw-bold">
            <span class="display-6"><?php echo $product_type; ?></span>
        </div>
        <div class="about-product text-center mt-2"><div class="mt-2 mb-4"><img class="img-fluid img-thumbnail w-50 h-50 img-blur rounded" src=<?=$img_url.$img?> width="300"></div>
            <div>
                <span class="display-6 mb-2">Description</span>
                <h6 class="mt-0 text-black fw-bold  w-75 text-center m-auto py-2"><?php echo $record['desc']; ?></h6>
            </div>
        </div>
        <div class="stats mt-2 fw-bold">
            <div class="d-flex justify-content-between p-price"><span> <i class="fas fa-user"></i> Selled by: </span><span><?php echo $sell_pdo['name']; ?> <?php echo $sell_pdo['lastname']; ?></div>
            <div class="d-flex justify-content-between p-price"><span> <i class="fas fa-box-tissue"></i> Products publicated: </span><?php echo $sell_pdo['publicated_products']; ?></div>
            <div class="d-flex justify-content-between p-price"><span> <i class="fas fa-check-circle"></i> Products selled: </span><span><?php echo $sell_pdo['quality']; ?></span></div>
        </div>
        <div class="d-flex justify-content-between total font-weight-bold mt-4 fw-bold"><span>Price: </span><span><?php echo $record['price']; ?>U$S</span></div>
        <hr class="my-4 "> 
        <div class="text-center">
            <span class="fw-bold fs-5 p-2 text-center">¿Want to buy it?</span>
        </div>
        <div class="container-fluid mt-5 p-2 paymentship-method fw-bold">
            <span><i class="fab fa-paypal fa-lg "></i> <a href="">Paypal</a> </span>
            <span><i class="fab fa-cc-visa fa-lg "></i> <a href="">Visa</a></span>
            <span><i class="fab fa-cc-mastercard fa-lg "></i> <a href="">Mastercard</a></span>
        </div>
    </div>
    <?php } ?>
</div>

</body>
<style>
*{

}
.paymentship-method{
    display: flex;
    flex-direction: row;
    justify-content: center;
    margin: auto;
}

.paymentship-method span{
    margin: 0 1.2rem;
}

</style>
</html>