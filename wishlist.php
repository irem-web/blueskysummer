<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = 'location:login.php';
    }

    include 'elemanlar/add_cart.php';

    if (isset($_POST['delete_item'])) {

        $wishlist_id = $_POST['wishlist_id'];
        $wishlist_id = filter_var($wishlist_id, FILTER_SANITIZE_STRING);

        $verify_delete = $conn->prepare("SELECT * FROM `istek_listesi` WHERE id = ?");
        $verify_delete->execute([$wishlist_id]);

        if ($verify_delete->rowCount() > 0) {

            $delete_wishlist_id = $conn->prepare("DELETE FROM `istek_listesi` WHERE id = ?");
            $delete_wishlist_id->execute([$wishlist_id]);
            $success_msg[] = 'listeden öğe silindi';
        } else {
            $warning_msg[] = 'öğe zaten silindi';
        }
    }

    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - İstek Listesi Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>İstek Listem</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>İstek Listem </span> 
        </div>
    </div>
    <div class="products">
        <div class="heading">
            <h1>İstek Listem</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total = 0;

                $select_wishlist = $conn->prepare("SELECT * FROM `istek_listesi` WHERE kullanici_id = ?");
                $select_wishlist->execute([$user_id]);

                if ($select_wishlist->rowCount() > 0) {
                    while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){

                        $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                        $select_products->execute([$fetch_wishlist['urun_id']]);

                        if ($select_products->rowCount() > 0) {
                            $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="" method="post" class="box" <?php if($fetch_products['stok'] == 0){echo "disabled";} ?>>
                <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
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
                    <div class="button">
                        <div><h3><?= $fetch_products['isim']; ?></h3></div>
                        <div>
                            <button type="submit" name="add_to_cart"> <i class="bx bx-cart"></i></button>
                            <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="bx bxs-show"></a>
                            <button type="submit" name="delete_item" onclick="return confirm('İstek listesinden kaldır');"><i class="bx bx-x"></i></button>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id']; ?>">
                    <div class="flex">
                        <p class="price">fiyat ₺<?= $fetch_products['fiyat']; ?>/-</p>
                    </div>
                    <div class="flex">
                        <input type="hidden" name="qty" required min="1" value="1" max="99" maxlenght="2" class="qty">
                        <a href="checkout.php?get_id=<?= $fetch_products['id']; ?>" class="btn">şimdi satın al</a>
                    </div>
                </div>
            </form>
            <?php
                        $grand_total+= $fetch_wishlist['fiyat'];
                        }
                    }
                } else {
                    echo '
                        <div class="empty">
                            <p>Henüz ürün eklenmedi!</p>   
                        </div>
                    ';
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