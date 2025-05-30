<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    include 'elemanlar/add_wishlist.php';
    include 'elemanlar/add_cart.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Ürün ara Sayfası</title>

	<link rel="stylesheet" type="text/css" href="css/user_style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/
    font-awesome/6.2.0/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Ürü Ara</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Ürün Ara </span> 
        </div>
    </div>

    <div class="products">
        <div class="heading">
            <h1>arama sonuçları</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                if (isset($_POST['search_product']) or isset($_POST['search_product_btn'])) {

                    $search_products = $_POST['search_product'];
                    $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE isim LIKE '%{$search_products}%' AND durum = ?");
                    $select_products->execute(['active']);

                    if ($select_products->rowCount() > 0) {
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                            $product_id = $fetch_products['id'];

            ?>
            <form action="" method="post" class="box" <?php if($fetch_products['stok'] == 0){echo "disabled";} ?> >
                
                <img src="image/<?= $fetch_products['fotograf']; ?>" class="image">

                <?php if($fetch_products['stok'] > 9){ ?>
                    <span class="stock" style="color: green;">Stokta Var</span>
                <?php }elseif($fetch_products['stok'] == 0){ ?>
                    <span class="stock" style="color: red;">Stoklar Tükendi</span>
                <?php }else{ ?>
                    <span class="stock" style="color: red;">Acele et, tükeniyor <?= $fetch_products['stok']; ?></span>
                <?php  }?>
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <div class="button">
                        <div> <h3 class="name"><?= $fetch_products['isim']; ?></h3> </div>
                        <div>
                            <button type="submit" name="add_to_cart"><i class="bx bx-cart"></i></button>
                            <button type="submit" name="add_to_wishlist"><i class="bx bx-heart"></i></button>
                            <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show"></a>
                        </div>
                    </div>
                    <p class="price">fiyat ₺<?= $fetch_products['fiyat']; ?></p>
                    <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                    <div class="flex-btn">
                        <a href="checkout.php?get_id=<?= $fetch_products['id'] ?>" class="btn">Şimdi satın al</a>
                        <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
                    </div>
                </div>
            </form>
            <?php
                        }
                    }else{
                        echo '
                            <div class="empty">
                                <p>ürün bulunamadı</p>   
                            </div>
                        ';
                    }
                }else{
                    echo '
                        <div class="empty">
                            <p>lütfen başka bir şey arayın</p>   
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