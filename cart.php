<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = 'location:login.php';
    }

    if (isset($_POST['update_cart'])) {  

        $cart_id = $_POST['cart_id'];  
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING); 

        $qty = $_POST['qty'];  
        $qty = filter_var($qty, FILTER_SANITIZE_STRING); 

        $update_qty = $conn->prepare("UPDATE `kart` SET miktar = ? WHERE id = ?");  
        $update_qty->execute([$qty, $cart_id]); 

        $success_msg[] = 'sepet miktarı başarıyla güncellendi';  
    }  


    if (isset($_POST['delete_item'])) {

        $cart_id = $_POST['cart_id'];
        $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

        $verify_delete_item = $conn->prepare("SELECT * FROM `kart` WHERE id = ?");
        $verify_delete_item->execute([$cart_id]);

        if ($verify_delete_item->rowCount() > 0) {

            $delete_cart_id = $conn->prepare("DELETE FROM `kart` WHERE id = ?");
            $delete_cart_id->execute([$cart_id]);

            $success_msg[] = 'Sepet öğesi başarıyla silindi';
        } else {
            $warning_msg[] = 'Sepet öğesi zaten silindi';
        }
    }


    if (isset($_POST['empty_cart'])) {

        $verify_empty_cart = $conn->prepare("SELECT * FROM `kart` WHERE kullanici_id = ?");
        $verify_empty_cart->execute([$user_id]);

        if ($verify_empty_cart->rowCount() > 0) {

            $delete_cart_id = $conn->prepare("DELETE FROM `kart` WHERE kullanici_id = ?");
            $delete_cart_id->execute([$user_id]);

            $success_msg[] = 'sepetiniz zaten boş';
        } else {
            $warning_msg[] = 'sepetiniz zaten boş';
        }
    }

    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Kullanıcı Sepeti</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Sepet</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Sepet </span>
        </div>
    </div>
    <div class="products">
        <div class="heading">
            <h1>Sepetim</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `kart` WHERE kullanici_id = ?");
                $select_cart->execute([$user_id]);

                if ($select_cart->rowCount() > 0) {
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                        $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                        $select_products->execute([$fetch_cart['urun_id']]);

                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="" method="post" class="box" <?php if($fetch_products['stok'] == 0){echo "disabled";}; ?>>
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                <img src="image/<?= $fetch_products['fotograf']; ?>" class="image">
                <?php if($fetch_products['stok'] > 9){ ?>
                    <span class="stock" style="color: green;">stokta var</span>
                <?php }elseif($fetch_products['stok'] == 0){ ?>
                    <span class="stock" style="color: red;">stoklar tükendi</span>
                <?php }else{ ?>
                    <span class="stock" style="color: red;">acele et tükeniyor <?= $fetch_products['stok']; ?> adet kaldı</span>
                <?php } ?>
                <div class="content">
                    <img src="image/shape-19.png" class="shap">
                    <h3 class="name"><?= $fetch_products['isim']; ?></h3>
                    <div class="flex-btn">
                        <p class="price">fiyat ₺<?= $fetch_products['fiyat']; ?>/-</p>
                        <input type="number" name="qty" required min="1" value="<?= $fetch_cart['miktar'] ?>" max="99" maxlength="2" class="box qty">
                        <button type="submit" name="update_cart" class="bx bxs-edit fa-edit box"></button>
                    </div>
                    <div class="flex-btn">
                        <p class="sub-total">ara toplam : <span>₺<?= $sub_total = ($fetch_cart['miktar']*$fetch_cart['fiyat']); ?></span></p>
                        <button type="submit" name="delete_item" class="btn" onclick="return confirm('sepetten sil');">sil</button>
                    </div>
                </div>
            </form>
            <?php

                        $grand_total += $sub_total;
                        }else{
                            echo '
                                <div class="empty">
                                     <p>hiçbir ürün bulunamadı!</p>
                                </div>
                            ';
                        }
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>henüz ürün eklenmedi!</p>
                        </div>
                    ';
                }
            ?>
        </div>
        <?php if($grand_total != 0){ ?>
            <div class="cart-total">
                <p>ödenecek toplam tutar : <span> ₺ <?= $grand_total; ?></span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm('Sepetinizi boşaltmak istediğinizden emin misiniz?');">Boş sepet</button>
                    </form>
                    <a href="checkout.php" class="btn">Ödeme işlemine devam et</a>
                </div>
            </div>
        <?php } ?>    
    </div>
    


















    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>