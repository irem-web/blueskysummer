<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
        header('location:login.php');
    }

    

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Kullanıcı Sipariş Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Siparişlerim</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Siparişlerim </span> 
        </div>
    </div>
    <div class="orders">
        <div class="heading">
            <h1>Siparişlerim</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM `siparisler` WHERE kullanici_id = ? ORDER BY tarih DESC");
                $select_orders->execute([$user_id]);

                if ($select_orders->rowCount() > 0) {
                    while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $product_id = $fetch_order['urun_id'];

                        $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                        $select_products->execute([$product_id]);

                        if ($select_products->rowCount() > 0) {
                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

            ?>
            <div class="box" <?php if($fetch_order['durum'] == 'iptal edildi'){echo 'style = "border:2px solid red"';} ?>>
                <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                    <img src="image/<?= $fetch_products['fotograf'] ?>" class="image">
                    <p class="date"> <i class="bx bxs-calender-alt"></i> <?= $fetch_order['tarih']; ?></p>
                    <div class="content">
                        <img src="image/shape-19.png" class="shap">
                        <div class="row">
                            <h3 class="name"><?= $fetch_products['isim']?></h3>
                            <p class="price">fiyat : ₺<?= $fetch_products['fiyat'] ?>/-</p>
                            <p class="status" style="color:<?php if($fetch_order['durum'] == 'teslim edilmiş'){echo "green";}elseif($fetch_order['durum'] == 'iptal edildi'){echo "red";}else{echo "orange";} ?>"><?= $fetch_order['durum']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                            }
                        }
                    }
                }else{
                    echo '<p class="empty">henüz sipariş verilmedi</p>';
                }
            ?>
        </div>
    </div>

    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>