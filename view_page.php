<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    $pid = $_GET['pid'];

    include 'elemanlar/add_wishlist.php';
    include 'elemanlar/add_cart.php';

    

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Ürün Detay Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Ürün Detay</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Ürün Detay </span> 
        </div>
    </div>
    <section class="view_page">
        <div class="heading">
            <h1>Ürün detayı</h1>
            <img src="image/separator-img.png">
        </div>
        <?php
            if (isset($_GET['pid'])) {
                $pid = $_GET['pid'];
                $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                $select_products->execute([$pid]);

                if ($select_products->rowCount() > 0) {
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){     

        ?>
        <form action="" method="post" class="box">
            <div class="img-box">
                <img src="image/<?= $fetch_products['fotograf']; ?>">
            </div>
            <div class="detail">
                <?php if($fetch_products['stok'] > 9){ ?>
                    <span class="stock" style="color: green;">stokta var</span>
                <?php }elseif($fetch_products['stok'] == 0){ ?>
                    <span class="stock" style="color: red;">stoklar tükendi</span>
                <?php }else{ ?>
                    <span class="stock" style="color: red;">acele et tükeniyor <?= $fetch_products['stok']; ?> adet kaldı</span>
                <?php } ?>
                <p class="price">fiyat ₺<?= $fetch_products['fiyat']; ?>/-</p>
                <div class="name"><?= $fetch_products['isim']; ?></div>
                <p class="product-detail"><?= $fetch_products['urun_detayi']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                <div class="button">
                    <button type="submit" name="add_to_wishlist" class="btn">istek listesine ekle <i class="bx bx-heart"></i> </button>
                    <input type="hidden" name="qty" value="1" min="0" class="quantity">
                    <button type="submit" name="add_to_cart" class="btn">sepete ekle <i class="bx bx-cart"></i> </button>
                </div>
            </div>
        </form>

        <?php     
                    }
                }
            }
        ?>
    </section>
    <div class="products">
        <div class="heading">
            <h1>benzer ürünler</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <img src="image/separator-img.png">
        </div>
        <?php include 'elemanlar/shop.php'; ?>
    </div>

















    

    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>