<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    if (isset($_GET['get_id'])) {
        $get_id = $_GET['get_id'];
    }else{
        $get_id = '';
        header('location:order.php');
    }

    if (isset($_POST['cancel'])) {

        $update_order = $conn->prepare("UPDATE `siparisler` SET durum = ? WHERE id = ?");
        $update_order->execute(['iptal edildi', $get_id]);

        header('location:order.php');
    }

    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Sipariş Detayları Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Sipariş Detayları</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Sipariş Detayları </span> 
        </div>
    </div>

    <div class="order-detail">
        <div class="heading">
            <h1>Sipariş Detaylarım</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_orders = $conn->prepare("SELECT * FROM `siparisler` WHERE id = ? LIMIT 1");
                $select_orders->execute([$get_id]);

                if ($select_orders->rowCount() > 0) {

                    while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ? LIMIT 1");
                        $select_products->execute([$fetch_order['urun_id']]);
                        if ($select_products->rowCount() > 0) {
                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                                $sub_total = ($fetch_order['fiyat']* $fetch_order['miktar']);
                                $grand_total += $sub_total;
                          
            ?>
            <div class="box">
                <div class="col">
                    <p class="title"> <i class="bx bxs-calendar-alt"></i><?= $fetch_order['tarih'];?></p>
                    <img src="image/<?= $fetch_products['fotograf']; ?>" class="image">
                    <p class="price">₺<?= $fetch_products['fiyat']; ?></p>
                    <h3 class="name"><?= $fetch_products['isim']; ?></h3>
                    <p class="grand-total">ödenecek toplam tutar : <span>₺<?= $grand_total; ?>/-</span></p>
                </div>
                <div class="col">
                    <p class="title">fatura adresi</p>
                    <p class="user"><i class="bx bx-user"></i><?= $fetch_order['isim']; ?></p>
                    <p class="user"><i class="bx bx-phone"></i><?= $fetch_order['numara']; ?></p>
                    <p class="user"><i class="bx bx-envelope"></i><?= $fetch_order['email']; ?></p>
                    <p class="user"><i class="bx bx-map"></i><?= $fetch_order['adres']; ?></p>
                    <p class="status" style="color:<?php if($fetch_order['durum'] == 'teslim edilmiş'){echo "green";}elseif($fetch_order['durum'] == 'iptal edildi'){echo "red";}else{echo "orange";} ?>"><?= $fetch_order['durum']; ?></p>
                        <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn" style="line-height: 3;">tekrar sipariş ver</a>
                        <form action="" method="post">
                            <button type="submit" name="cancel" class="btn" onclick="return confirm('bu ürünü iptal etmek istiyor musunuz');">iptal et</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
            <?php
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